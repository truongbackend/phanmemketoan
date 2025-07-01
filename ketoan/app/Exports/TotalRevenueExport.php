<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class TotalRevenueExport implements FromCollection, WithHeadings
{
    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to   = $to;
    }

    public function collection()
    {
        return Order::with(['user:id,name,email'])
            ->select('order_user_id', 'companyName', 'companyTax')
            ->selectRaw('SUM(total_amount) as total_spent')
            ->where('status', 2)
            ->whereBetween('created_at', [
                $this->from . ' 00:00:00',
                $this->to . ' 23:59:59'
            ])
            ->groupBy('order_user_id', 'companyName', 'companyTax')
            ->orderByDesc('total_spent')
            ->get()
            ->map(function ($item) {
                $user = optional($item->user);
                return [
                    'Tên'          => $user->name ?? 'Không xác định',
                    'Email'        => $user->email ?? 'N/A',
                    'Công ty'      => $item->companyName ?? 'N/A',
                    'Mã số thuế'   => $item->companyTax ?? 'N/A',
                    'Tổng chi tiêu'=> $item->total_spent,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tên',
            'Email',
            'Công ty',
            'Mã số thuế',
            'Tổng chi tiêu',
        ];
    }
}
