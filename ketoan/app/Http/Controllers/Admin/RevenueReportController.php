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
}
