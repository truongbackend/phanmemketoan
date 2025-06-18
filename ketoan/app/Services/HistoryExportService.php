<?php


namespace App\Services;

use App\Repositories\HistoryExportRepository;
use Carbon\Carbon;

class HistoryExportService
{
    protected $historyExportRepository;

    public function __construct(HistoryExportRepository $historyExportRepository)
    {
        $this->historyExportRepository = $historyExportRepository;
    }

    public function importFromArray(array $rows, $historyUserId)
    {

        $batchSize = 100;
        $inserted = [];
        $duplicates = [];

        foreach (array_chunk($rows, $batchSize) as $batch) {
            $data = [];
            $pairs = [];
            foreach ($batch as $row) {
                $pairs[] = [
                    'order_code' => $row[0],
                    'order_date' => $row[1]
                ];
            }

            $existingKeys = $this->historyExportRepository->findExistingOrderCodes($pairs);
      
            foreach ($batch as $row) {
                $order_code = $row[0];
                $order_date = $row[1];
                $key = $order_code . '|' . $order_date;
                $now = now();

                $record = [
                    'order_code'           => $order_code,
                    'order_date'           => $order_date,
                    'order_total_amount'   => $row[2],
                    'order_vat_amount'     => $row[3],
                    'order_paid_amount'    => $row[4],
                    'order_export_receipt' => "".$this->mapExportReceipt($row[5]),
                    'history_instance_id'  => null,
                    'history_user_id'      => $historyUserId,
                    'created_at'           => $now,
                    'updated_at'           => $now,
                ];

                if (isset($existingKeys[$key])) {
                    $duplicates[] = $record;
                } else {
                    $data[] = $record;
                    $inserted[] = $record;
                }
            }

            $this->historyExportRepository->insertBatch($data);
        }
        return [
            'inserted'   => $inserted,
            'duplicates' => $duplicates,
        ];
    }

    private function mapExportReceipt($value)
    {
        $value = mb_strtolower(trim($value));
        if ($value === mb_strtolower('Đã xuất hóa đơn')) {
            return 1;
        }
        if ($value === mb_strtolower('Không xuất hóa đơn')) {
            return 0;
        }
        return null;
    }

    public function getPaginated($userId, $filters, $perPage = 20)
    {
        return $this->historyExportRepository->getPaginated($userId, $filters, $perPage);
    }

    public function deleteByOrderCodes($userId, array $orderCodes)
    {
        $existingOrderCodes = $this->historyExportRepository->findExistingOrderCodes2($userId, $orderCodes);

        $notFound = array_diff($orderCodes, $existingOrderCodes);

        $deletedCount = 0;
        $deletedOrderCodes = [];
        if (!empty($existingOrderCodes)) {
            $deletedCount = $this->historyExportRepository->deleteByOrderCodes($userId, $existingOrderCodes);
            $deletedOrderCodes = $existingOrderCodes;
        }

        return [
            'deleted_count' => $deletedCount,
            'deleted_order_codes' => $deletedOrderCodes,
            'not_found_order_codes' => array_values($notFound),
        ];
    }


}
