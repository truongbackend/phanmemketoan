<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportHistoryRequest;
use App\Services\HistoryExportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportHistoryController extends Controller
{
    public $history_export_service;

    public function __construct(HistoryExportService $history_export_service)
    {
        $this->history_export_service = $history_export_service;
    }

    public function importHistorReceipt(ImportHistoryRequest $request)
    {
        try {
            $request->validated();
            $user = auth()->user();
            $historyUserId = $user->id;

            $fileHistoryData = Excel::toArray([], $request->file('file_history'));

            $fileHistoryData = array_map(function($sheet) {
                $filtered = array_filter($sheet, function($row) {
                    for ($i = 0; $i <= 4; $i++) {
                        if (!isset($row[$i]) || $row[$i] === null || $row[$i] === '') {
                            return false;
                        }
                    }
                    return substr($row[0], 0, 2) === 'WB';
                });

                $result = array_map(function($row) {
                    return array_slice($row, 0, 6);
                }, $filtered);

                return array_values($result);
            }, $fileHistoryData);

            $importRows = $fileHistoryData[0] ?? [];
            $result = $this->history_export_service->importFromArray($importRows, $historyUserId);

            return response()->json([
                                    'message'    => 'Import thành công',
                                    'inserted_count'   => count($result['inserted']),
                                    'duplicate_count'  => count($result['duplicates']),
                                    'inserted'   => $result['inserted'],
                                    'duplicates' => $result['duplicates'],
                                ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Dữ liệu không hợp lệ: ' . $e->getMessage()], 422);
        }
    }

     public function getList(Request $request)
    {
        $user = auth()->user();

        $filters = [
            'order_code' => $request->input('order_code'),
            'order_export_receipt' => $request->input('order_export_receipt'),
            'order_date_from' => $request->input('order_date_from'),
            'order_date_to' => $request->input('order_date_to'),
        ];

        $perPage = $request->input('per_page', 20);

        $result = $this->history_export_service->getPaginated($user->id, $filters, $perPage);

        return response()->json($result);
    }

    public function destroy(Request $request)
    {
        $user = auth()->user();
        $orderCodes = $request->input('order_codes', []);

        if (!is_array($orderCodes) || empty($orderCodes)) {
            return response()->json([
                'message' => 'Vui lòng cung cấp mã đơn hàng để xoá.',
            ], 400);
        }

        $result = $this->history_export_service->deleteByOrderCodes($user->id, $orderCodes);

        return response()->json([
            'message' => 'Xoá hoàn tất',
            'deleted_count' => $result['deleted_count'],
            'deleted_order_codes' => $result['deleted_order_codes'],
            'not_found_order_codes' => $result['not_found_order_codes'],
        ]);
    }
}
