<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportDataRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Traits\LoggerTrait;
class ViettelPostImportController extends Controller
{
    use LoggerTrait;

    public function importData(ImportDataRequest $request)
    {
        $validated = $request->validated();

        $fileInfoData = Excel::toArray([], $request->file('file_info'));
        $filePushSaleData = Excel::toArray([], $request->file('file_push_sale'));
        $fileDataProductData = Excel::toArray([], $request->file('file_data_product'));

        $dateFrom = \DateTime::createFromFormat('d/m/Y H:i:s', $validated['reporting_date_from']);
        $dateTo = \DateTime::createFromFormat('d/m/Y H:i:s', $validated['reporting_date_to']);

        $fileInfoDataFiltered = collect($fileInfoData[0])
            ->filter(function($row) use ($dateFrom, $dateTo) {
                for ($i = 0; $i <= 10; $i++) {
                    if (empty($row[$i])) {
                        return false;
                    }
                }

                if (!isset($row[2]) || substr($row[2], 0, 2) !== 'WB') return false;
                if (!isset($row[33]) || $row[33] !== 'Giao thành công') return false;
                if (empty($row[42])) return false;

                $date = \DateTime::createFromFormat('d/m/Y H:i:s', $row[42]);
                if (!$date) return false;
                if ($date < $dateFrom || $date > $dateTo) return false;

                return true;
            })
            ->values()
            ->all();

        $this->loggerDataRequest([
            'file' => "viettel_post_file_info",
            'data' => $fileInfoDataFiltered
        ]);

        $filePushSaleFiltered = collect($filePushSaleData[0])
            ->filter(function($row) {
                foreach ([0, 2, 3, 4] as $i) {
                    if (empty($row[$i])) {
                        return false;
                    }
                }
                return true;
            })
            ->values()
            ->all();

        $this->loggerDataRequest([
            'file' => "push_sale_file_info",
            'data' => $filePushSaleFiltered
        ]);

        $fileDataProductDataFiltered = collect($fileDataProductData[0])
            ->filter(function($row) {
                for ($i = 0; $i <= 2; $i++) {
                    if (empty($row[$i])) {
                        return false; 
                    }
                }
                return true; 
            })
            ->values()
            ->all();

        $this->loggerDataRequest([
            'file' => "product_data_file_info",
            'data' => $fileDataProductDataFiltered
        ]);

        $fileInfoDataMerged = collect($fileInfoDataFiltered)->map(function($infoRow) use ($filePushSaleFiltered) {
            $matchingPushSales = collect($filePushSaleFiltered)
                ->filter(function($pushRow) use ($infoRow) {
                    return isset($infoRow[2], $pushRow[2]) && $infoRow[2] === $pushRow[2];
                })
                ->values()
                ->all();
            $infoRow['push_sale_details'] = $matchingPushSales;
            return $infoRow;
        });

        $type1_has_special = [];
        $type1_no_special = [];
        $type3 = [];
        $specialValues = [0, 20000, 30000, 0.0, 20000.0, 30000.0, '0', '20000', '30000'];

        foreach ($fileInfoDataMerged as $infoRow) {
            if (!isset($infoRow['push_sale_details'][0])) continue;
            $pushRowDetai = $infoRow['push_sale_details'][0];
            if (!isset($pushRowDetai[11], $pushRowDetai[13], $infoRow[27])) continue;
            $diff = floatval($pushRowDetai[11]) - floatval($pushRowDetai[13]) - floatval($infoRow[27]);
            if ($diff === 0.0) {
                // Loại 1
                $hasSpecial = in_array($pushRowDetai[11], $specialValues, true) ||
                             in_array($infoRow[27], $specialValues, true);
            
                if ($hasSpecial) {
                    $type1_has_special[] = $infoRow;
                } else {
                    $type1_no_special[] = $infoRow;
                }
            } elseif ($diff < 0) {
                // Loại 3
                $type3[] = $infoRow;
            }
        }

        $this->loggerDataRequest([
            'type1_has_special' => $type1_has_special,
            'type1_no_special' => $type1_no_special,
            'type3' => $type3
        ]);
        
        return response()->json([
            'message' => 'Phân loại dữ liệu thành công',
            'type1_has_special' => $type1_has_special,
            'type1_no_special' => $type1_no_special,
            'type3' => $type3
        ]);
    }

    public function downloadExport(Request $request)
    {
        // Lấy dữ liệu export, ví dụ demo lấy từ request hoặc từ xử lý logic
        $type = $request->input('type', 'sales'); // 'sales' hoặc 'service'
        $format = $request->input('format', 'xlsx'); // 'csv' hoặc 'xlsx'
        $dataExportService = new \App\Services\DataExportService();
        $headings = $dataExportService->getExportHead($type);

        $columns = array_keys($headings);
        $headerRow = array_values($headings);

        // Demo dữ liệu, thực tế lấy từ xử lý logic
        $data = [
            [
                'A' => 'Bán lẻ',
                'B' => 'Tiền mặt',
                'C' => 'Có',
            ],[
                'A' => 'Bán lẻ 2',
                'B' => 'Tiền mặt 2',
                'C' => 'Có 2',
            ],
        ];

        // Đảm bảo dữ liệu đúng thứ tự cột
        $rows = collect($data)->map(function($row) use ($columns) {
            return array_map(function($col) use ($row) {
                return $row[$col] ?? '';
            }, $columns);
        })->toArray();
        array_unshift($rows, $headerRow);
        // Xuất file
        $filename = 'export_' . date('Ymd_His') . '.' . $format;
        if ($format === 'csv') {
            $handle = fopen('php://memory', 'r+');
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            rewind($handle);
            $csv = stream_get_contents($handle);
            fclose($handle);
            return response($csv)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        } else {
            // XLSX dùng Laravel-Excel
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SimpleArrayExport($rows), $filename);
        }
    }
}
