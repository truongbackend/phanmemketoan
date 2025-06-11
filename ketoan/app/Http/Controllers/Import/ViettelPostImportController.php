<?php
//jhejejeje

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\DownLoadExportViettelPostRequest;
use App\Http\Requests\ImportDataRequest;
use App\Repositories\ExportReceiptViettelPostRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use App\Traits\LoggerTrait;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class ViettelPostImportController extends Controller
{
    use LoggerTrait;

    public $exportReceiptViettelPostRepository;

    public function __construct(ExportReceiptViettelPostRepository $exportReceiptViettelPostRepository)
    {
        $this->exportReceiptViettelPostRepository = $exportReceiptViettelPostRepository;
    }

    public function importData(ImportDataRequest $request)
    {
        try {
            $export_instance_id = Str::random(40);

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
            
                // dd($fileInfoDataFiltered[513]);
            // $this->loggerDataRequest([
            //     'file' => "viettel_post_file_info",
            //     'data' => $fileInfoDataFiltered
            // ]);

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

            // $this->loggerDataRequest([
            //     'file' => "product_data_file_info",
            //     'data' => $fileDataProductDataFiltered
            // ]);
            
            $fileInfoDataMerged = collect($fileInfoDataFiltered)->map(function($infoRow) use ($filePushSaleFiltered) {
                $matchingPushSales = collect($filePushSaleFiltered)
                    ->filter(function($pushRow) use ($infoRow) {
                        return isset($infoRow[2], $pushRow[2]) && $infoRow[2] === $pushRow[2];
                    })
                    ->values()
                    ->all();
                $infoRow['push_sale_details'] = $matchingPushSales;
                return $infoRow;
            })->values()->all();

            $dataCaseNormal = [];
            $dataCaseException = [];

            $dataCaseNormalView = [];
            $dataCaseExceptionView = [];

            $specialValues = [0, 20000, 30000, 0.0, 20000.0, 30000.0, '0', '20000', '30000'];

            foreach ($fileInfoDataMerged as $infoRow) {
                if (!isset($infoRow['push_sale_details'][0])) continue;
                $pushRowDetai = $infoRow['push_sale_details'][0];
                
                $diff = floatval($pushRowDetai[11]) - floatval($pushRowDetai[34]) - floatval($infoRow[27]);
            
                $infoSelected = [
                    "delivery_code"      => $infoRow[1] ?? null,
                    "date_change_status" => $infoRow[42] ?? null,
                    "total_amount"       => $pushRowDetai[11] ?? null,
                    "cod"                => $infoRow[27] ?? null,
            
                ];
    
                if ($diff === 0.0) {
                    $hasSpecial = in_array($pushRowDetai[11], $specialValues, true) &&
                                in_array($infoRow[27], $specialValues, true);
                    if ($hasSpecial || (empty($pushRowDetai[11]) && empty($infoRow[27]))) {
                        $infoRow['allow_sales_invoice_export'] = true;
                        $infoSelected['allow_sales_invoice_export'] = true;
                        
                        $dataCaseException[] = $infoRow;
                        $dataCaseExceptionView[] = $infoSelected;
                    } else {
                        $dataCaseNormal[] = $infoRow;
                        $dataCaseNormalView[] = $infoSelected;
                    }
                } elseif ($diff > 0) {
                    $infoRow['allow_sales_invoice_export'] = true;
                    $infoRow['allow_service_invoice_export'] = true;
                    $infoSelected['allow_sales_invoice_export'] = true;
                    $infoSelected['allow_service_invoice_export'] = true;

                    $dataCaseException[] = $infoRow;
                    $dataCaseExceptionView[] = $infoSelected;
                }
            }

            Cache::put("viettelpost.normal.{$export_instance_id}", $dataCaseNormal, 60 * 60 * 24 * 7); 
            Cache::put("viettelpost.exception.{$export_instance_id}", $dataCaseException, 60 * 60 * 24 * 7);
            Cache::put("viettelpost.merged.{$export_instance_id}", $fileInfoDataMerged, 60 * 60 * 24 * 7);
            
            return response()->json([
                'message' => 'Successfully imported data',
                'status' => true,
                'export_action' => count($dataCaseException) == 0,
                'export_instance_id' => $export_instance_id,
                'case_data' => $dataCaseExceptionView,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error data import',
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function downloadExportDemo(Request $request)
    {
        $type = $request->input('type', 'sales'); 
        $format = $request->input('format', 'xlsx');
        $export_instance_id = $request->input('export_instance_id');

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

    public function downloadExport(DownLoadExportViettelPostRequest $request)
    {
        $validated = $request->validated();
        $exportInstanceId = $validated['export_instance_id'];
        $arrDeliveryCodeExportSale = $request->input('arr_delivery_code_export_sale', []);
        $arrDeliveryCodeExportSale = is_array($arrDeliveryCodeExportSale) ? $arrDeliveryCodeExportSale : [];
        $arrDeliveryCodeExportService = $request->input('arr_delivery_code_export_service', []);
        $arrDeliveryCodeExportService = is_array($arrDeliveryCodeExportService) ? $arrDeliveryCodeExportService : [];
        
        $dataNormal = Cache::get("viettelpost.normal.{$exportInstanceId}", []);
        $dataException = Cache::get("viettelpost.exception.{$exportInstanceId}", []);
        $dataMerged = Cache::get("viettelpost.merged.{$exportInstanceId}", []);

        $dataExportSales = [];
        $dataExportServices = [];
        
        $dataExportService = new \App\Services\DataExportService();
        $headingsExportSales  = $dataExportService->getExportHead('sales');
        $headingsExportServices = $dataExportService->getExportHead('services');

        $columnsExportSales= array_keys($headingsExportSales);
        $headerRowExportSales = array_values($headingsExportSales);

        $columnsExportService = array_keys($headingsExportServices);
        $headerRowExportService = array_values($headingsExportServices);
    }
}
