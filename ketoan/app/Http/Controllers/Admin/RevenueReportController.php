<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TotalRevenueExport;

class RevenueReportController extends Controller
{
    public function byYear()
    {
        $revenue = Order::selectRaw('YEAR(created_at) as year, SUM(total_amount) as total_revenue')
            ->groupByRaw('YEAR(created_at)')
            ->orderBy('year', 'asc')
            ->get();

        return response()->json($revenue);
    }

    /**
     * Tổng doanh thu theo tháng
     */
    public function byMonth()
    {
        $rawData = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_amount) as total_revenue')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('year asc, month asc')
            ->get();
        $year = request()->get('year', now()->year);
        $result = [];
        for ($m = 1; $m <= 12; $m++) {
            $result[] = [
                'year' => (int)$year,
                'month' => $m,
                'total_revenue' => 0,
            ];
        }
        foreach ($rawData as $item) {
            if ($item->year == $year) {
                $index = $item->month - 1;
                $result[$index]['total_revenue'] = $item->total_revenue;
            }
        }

        return response()->json($result);
    }

    public function byDay()
    {
        $revenue = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total_revenue')
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json($revenue);
    }

    public function totalOrder()
{
    $now       = Carbon::now();
    $start30   = $now->copy()->subDays(30);
    $prevStart = $now->copy()->subDays(60);
    $prevEnd   = $now->copy()->subDays(30);

    $totalRevenue = Order::sum('total_amount');

    $revenue30     = Order::whereBetween('created_at', [$start30, $now])->sum('total_amount');
    $revenuePrev30 = Order::whereBetween('created_at', [$prevStart, $prevEnd])->sum('total_amount');
    if ($revenuePrev30 > 0) {
        $pct30 = round((($revenue30 - $revenuePrev30) / $revenuePrev30) * 100, 2);
    } elseif ($revenue30 > 0) {
        $pct30 = 100;
    } else {
        $pct30 = 0;
    }

    $monthly     = Order::whereYear('created_at', $now->year)
                        ->whereMonth('created_at', $now->month)
                        ->sum('total_amount');
    $lastMonth   = $now->copy()->subMonth();
    $prevMonthly = Order::whereYear('created_at', $lastMonth->year)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->sum('total_amount');
    if ($prevMonthly > 0) {
        $pctMonthly = round((($monthly - $prevMonthly) / $prevMonthly) * 100, 2);
    } elseif ($monthly > 0) {
        $pctMonthly = 100;
    } else {
        $pctMonthly = 0;
    }

    $yearly     = Order::whereYear('created_at', $now->year)->sum('total_amount');
    $prevYearly = Order::whereYear('created_at', $now->year - 1)->sum('total_amount');
    if ($prevYearly > 0) {
        $pctYearly = round((($yearly - $prevYearly) / $prevYearly) * 100, 2);
    } elseif ($yearly > 0) {
        $pctYearly = 100;
    } else {
        $pctYearly = 0;
    }

    $users30     = User::whereBetween('created_at', [$start30, $now])->count();
    $prevUsers30 = User::whereBetween('created_at', [$prevStart, $prevEnd])->count();
    if ($prevUsers30 > 0) {
        $pctUsers30 = round((($users30 - $prevUsers30) / $prevUsers30) * 100, 2);
    } elseif ($users30 > 0) {
        $pctUsers30 = 100;
    } else {
        $pctUsers30 = 0;
    }

    return response()->json([
        'total_revenue'        => $totalRevenue,
        'revenue_30_days'      => $revenue30,
        'pct_change_30_days'   => $pct30,
        'monthly_revenue'      => $monthly,
        'pct_change_monthly'   => $pctMonthly,
        'yearly_revenue'       => $yearly,
        'pct_change_yearly'    => $pctYearly,
        'new_users_30_days'    => $users30,
        'pct_change_users_30d' => $pctUsers30,
    ]);
}


    public function listCustomersWithOrders(Request $request)
{
    $toRaw   = $request->query('to',   Carbon::today()->toDateString());
    $fromRaw = $request->query('from', Carbon::today()->subDays(29)->toDateString());

    try {
        $from = Carbon::createFromFormat('Y-m-d', $fromRaw)->startOfDay();
        $to   = Carbon::createFromFormat('Y-m-d', $toRaw)->endOfDay();
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Invalid date format, expected YYYY-MM-DD'
        ], 400);
    }

    $orders = Order::with(['user:id,name,email', 'package:id,name'])
        ->select('order_user_id', 'package_id', 'companyTax', 'companyName', 'created_at')
        ->where('status', 2)
        ->whereBetween('created_at', [$from, $to])
        ->orderBy('created_at', 'desc')
        ->get();

    $customers = $orders->map(function ($order) {
        $user    = optional($order->user);
        $package = optional($order->package);
        return [
            'user_id'     => $order->order_user_id,
            'user_name'   => $user->name      ?? 'Không xác định',
            'email'       => $user->email     ?? null,
            'package'     => $package->name   ?? 'Unknown package',
            'order_date'  => $order->created_at->format('Y-m-d'),
            'companyTax'  => $order->companyTax  ?? null,
            'companyName' => $order->companyName ?? null,
        ];
    });
    return response()->json($customers);
}
public function totalRevenueByUser()
{
    $from = request()->get('from');
    $to = request()->get('to');
    $perPage = request()->get('per_page', 10);

    // Nếu thiếu from/to, fallback về 30 ngày gần nhất
    if (!$from) {
        $from = now()->subDays(29)->format('Y-m-d');
    }
    if (!$to) {
        $to = now()->format('Y-m-d');
    }

    try {
        $fromDate = Carbon::createFromFormat('Y-m-d', $from)->startOfDay();
        $toDate   = Carbon::createFromFormat('Y-m-d', $to)->endOfDay();
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid date format, expected YYYY-MM-DD'], 400);
    }

    $query = Order::with(['user:id,name,email'])
        ->select('order_user_id', 'companyName', 'companyTax')
        ->selectRaw('SUM(total_amount) as total_spent')
        ->where('status', 2)
        ->whereBetween('created_at', [$fromDate, $toDate])
        ->groupBy('order_user_id', 'companyName', 'companyTax');

    $paginator = $query->orderByDesc('total_spent')->paginate($perPage);

    $data = $paginator->getCollection()->map(function ($item) {
        $user = optional($item->user);
        return [
            'user_id'     => $item->order_user_id,
            'user_name'   => $user->name ?? 'Không xác định',
            'email'       => $user->email ?? 'N/A',
            'companyName' => $item->companyName ?? 'N/A',
            'companyTax'  => $item->companyTax ?? 'N/A',
            'total_spent' => $item->total_spent,
        ];
    });

    return response()->json([
        'current_page' => $paginator->currentPage(),
        'last_page'    => $paginator->lastPage(),
        'per_page'     => $paginator->perPage(),
        'total'        => $paginator->total(),
        'data'         => $data,
    ]);
}

public function exportTotalRevenueByUser()
{
    $from = request()->get('from');
    $to = request()->get('to');

    return Excel::download(new TotalRevenueExport($from, $to), "tong_chi_tieu_{$from}_{$to}.xlsx");
}



}


