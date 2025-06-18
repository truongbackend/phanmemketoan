<?php

namespace App\Repositories;

use App\Models\HistoryExport;
use Illuminate\Support\Facades\DB;

class HistoryExportRepository
{
    public function findExistingOrderCodes(array $orderCodeDatePairs)
    {
        $existings = HistoryExport::where(function($query) use ($orderCodeDatePairs) {
            foreach ($orderCodeDatePairs as $pair) {
                $query->orWhere(function($q) use ($pair) {
                    $q->where('order_code', $pair['order_code'])
                      ->where('order_date', $pair['order_date']);
                });
            }
        })->get(['order_code', 'order_date'])->toArray();
        
        $existingKeys = [];
        foreach ($existings as $row) {
            $existingKeys[$row['order_code'].'|'.$row['order_date']] = true;
        }
        return $existingKeys;
    }

    public function insertBatch(array $data)
    {
        if (!empty($data)) {
            HistoryExport::insert($data);
        }
    }

    public function getPaginated($userId, $filters, $perPage = 20)
    {
        $query = HistoryExport::query()->where('history_user_id', $userId);

        if (!empty($filters['order_code'])) {
            $query->where('order_code', 'like', '%' . $filters['order_code'] . '%');
        }

        if (isset($filters['order_export_receipt'])) {
            $query->where('order_export_receipt', $filters['order_export_receipt']);
        }

        if (!empty($filters['order_date_from'])) {
            $query->where('order_date', '>=', $filters['order_date_from']);
        }
        if (!empty($filters['order_date_to'])) {
            $query->where('order_date', '<=', $filters['order_date_to']);
        }

        $query->orderByDesc('created_at');

        return $query->paginate($perPage);
    }

    public function findExistingOrderCodes2($userId, array $orderCodes)
    {
        return \App\Models\HistoryExport::where('history_user_id', $userId)
            ->whereIn('order_code', $orderCodes)
            ->pluck('order_code')
            ->toArray();
    }

    public function deleteByOrderCodes($userId, array $orderCodes)
    {
        return \App\Models\HistoryExport::where('history_user_id', $userId)
            ->whereIn('order_code', $orderCodes)
            ->delete();
    }


}
