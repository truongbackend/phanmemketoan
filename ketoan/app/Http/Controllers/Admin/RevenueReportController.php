<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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
    public function listCustomersWithOrders()
{
    $type = request()->get('type'); // day | month | year

    if (!in_array($type, ['day', 'month', 'year'])) {
        return response()->json(['error' => 'Invalid type, must be day, month or year'], 400);
    }

    $ordersQuery = Order::with('user:id,name,email')
        ->select('id', 'order_user_id', 'package_name', 'created_at');
    if ($type === 'day') {
        $date = request()->get('date');
        if (!$date) return response()->json(['error' => 'Date is required for day type'], 400);
        $ordersQuery->whereDate('created_at', $date);
    } elseif ($type === 'month') {
        $year = request()->get('year', now()->year);
        $month = request()->get('month', now()->month);
        $ordersQuery->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
    } elseif ($type === 'year') {
        $year = request()->get('year', now()->year);
        $ordersQuery->whereYear('created_at', $year);
    }

    $orders = $ordersQuery->orderBy('created_at', 'desc')->get();

    $customers = $orders->map(function ($order) {
        $user = optional($order->user);
        return [
            'user_id' => $order->order_user_id,
            'user_name' => $user->name ?? 'Không xác định',
            'email' => $user->email ?? null,
            'package' => $order->package_name,
            'order_date' => $order->created_at->format('Y-m-d'),
        ];
    });

    return response()->json($customers);
}






}
