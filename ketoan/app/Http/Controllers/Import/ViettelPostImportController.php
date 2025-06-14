<?php
//jhejejeje

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\DownLoadExportViettelPostRequest;
use App\Http\Requests\ImportDataRequest;
use App\Repositories\ExportReceiptViettelPostRepository;
use App\Services\DataExportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Exports\SimpleArrayExport;

use App\Traits\LoggerTrait;
use Dflydev\DotAccessData\Data;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;
use Illuminate\Support\Facades\Storage;

use ZipArchive;
class ViettelPostImportController extends Controller
{
    use LoggerTrait;

    public $exportReceiptViettelPostRepository;
    public $dataExportService;

    public function __construct(ExportReceiptViettelPostRepository $exportReceiptViettelPostRepository, DataExportService $dataExportService)
    {
        $this->exportReceiptViettelPostRepository = $exportReceiptViettelPostRepository;
        $this->dataExportService = $dataExportService;
    }

    public function columnSubmitReason()
    {
        $viettelPostConfig = config('col_submit_reason.viettel_post', []);

        return response()->json([
                'message' => 'Successfully retrieved column submit reason',
                'status' => true,
                'data' => $viettelPostConfig
            ]);
    }

    public function importData(ImportDataRequest $request)
    {
        try {
            $export_instance_id = Str::random(40);

            $validated = $request->validated();
            
            $inputSetting = [
                'export_receipt_number' => $validated['export_receipt_number'] ?? null,
                'posting_date' => $validated['posting_date'],
                'submission_reason' =>  $validated['submission_reason'] ?? [],
                'account_cash_expense_debt' =>  $validated['account_cash_expense_debt'] ?? null,
                'account_revenue_credit' =>     $validated['account_revenue_credit'] ?? null,
                'account_vat_tax' =>          $validated['account_vat_tax'] ?? null,
                'warehouse_code' =>        $validated['warehouse_code'] ?? null,
                'account_cost_of_goods_sold' =>     $validated['account_cost_of_goods_sold'] ?? null,
                'account_inventory' =>     $validated['account_inventory'] ?? null,
                'trigger_product_name' =>     $validated['trigger_product_name'] ?? null,
            ];

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

            $fileProductDataFiltered = collect($fileDataProductData[0])
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
                    "delivery_code"      => $infoRow[2] ?? null,
                    "date_change_status" => $infoRow[42] ?? null,
                    "total_amount"       => $pushRowDetai[11] ?? null,
                    "cod"                => $infoRow[27] ?? null,
            
                ];
    
                if ($diff == 0) {
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
            Cache::put("viettelpost.product.{$export_instance_id}", $fileProductDataFiltered, 60 * 60 * 24 * 7);
            Cache::put("viettelpost.setting.{$export_instance_id}", $inputSetting, 60 * 60 * 24 * 7);
            
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
        try{
            $validated = $request->validated();
            $exportInstanceId = $validated['export_instance_id'];
            $arrDeliveryCodeExportSale = $request->input('arr_delivery_code_export_sale', []);
            $arrDeliveryCodeExportSale = is_array($arrDeliveryCodeExportSale) ? $arrDeliveryCodeExportSale : [];
            $arrDeliveryCodeExportService = $request->input('arr_delivery_code_export_service', []);
            $arrDeliveryCodeExportService = is_array($arrDeliveryCodeExportService) ? $arrDeliveryCodeExportService : [];
          
            $dataNormal = Cache::get("viettelpost.normal.{$exportInstanceId}", []);
            $dataException = Cache::get("viettelpost.exception.{$exportInstanceId}", []);
            $dataMerged = Cache::get("viettelpost.merged.{$exportInstanceId}", []);
            $dataProducts = Cache::get("viettelpost.product.{$exportInstanceId}", []);
            $dataSetting = Cache::get("viettelpost.setting.{$exportInstanceId}", []);
            $dataSetting['shipping_service_tax'] = isset($validated['shipping_service_tax']) ? $validated['shipping_service_tax'] : "";
            
            //HANDLE SALES
            $dataExportSales = [];
            $dataExportServices = [];
            $dataExportSales = collect($dataException)->filter(function ($item) use ($arrDeliveryCodeExportSale) {
                                return in_array($item[2], $arrDeliveryCodeExportSale);
                            })->values();

            $dataExportSales = $dataExportSales->merge($dataNormal)->values();
            
            $dataExportSalesOutput = [];
            foreach($dataExportSales as $key => $itemExportSales) {
                $productCodeOfPushSaleProduct = array_column($itemExportSales['push_sale_details'], 4);
                $filteredProductsOfPushSaleProduct = collect($dataProducts)->filter(function ($item) use ($productCodeOfPushSaleProduct) {
                                        return in_array($item[0], $productCodeOfPushSaleProduct);
                                    })->values();
                $dataRowDetail = $this->dataExportService->exportTemplateSales($itemExportSales, $dataSetting, $filteredProductsOfPushSaleProduct);

                if($dataRowDetail['status'] == false) {
                    return response()->json([
                        'message' => $dataRowDetail['message'],
                        'status' => false,
                    ], 500);
                }

                $dataRowDetail = $dataRowDetail['data'];

                $dataExportSalesOutput = array_merge($dataExportSalesOutput, $dataRowDetail);
            }

            //HANDLE SERVICE
            $dataExportServices = collect($dataException)->filter(function ($item) use ($arrDeliveryCodeExportService) {
                                return in_array($item[2], $arrDeliveryCodeExportService);
                            })->values();

            $dataRowDetail = [];
            $dataExportServiceOutput = [];
            foreach($dataExportServices as $key => $itemExportServices) {
                $productCodeOfPushSaleProduct = array_column($itemExportServices['push_sale_details'], 4);
                $filteredProductsOfPushSaleProduct = collect($dataProducts)->filter(function ($item) use ($productCodeOfPushSaleProduct) {
                                        return in_array($item[0], $productCodeOfPushSaleProduct);
                                    })->values();
                $dataRowDetail = $this->dataExportService->exportTemplateServices($itemExportServices, $dataSetting, $filteredProductsOfPushSaleProduct);

                if($dataRowDetail['status'] == false) {
                    return response()->json([
                        'message' => $dataRowDetail['message'],
                        'status' => false,
                    ], 500);
                }

                $dataRowDetail = $dataRowDetail['data'];

                $dataExportServiceOutput = array_merge($dataExportServiceOutput, $dataRowDetail);
            }

            //EXPORT XLSX
            $dataExportService = new \App\Services\DataExportService();
            $headingsExportSales  = $dataExportService->getExportHead('sales');
            $headingsExportServices = $dataExportService->getExportHead('services');

            $exportsDir = storage_path('app/exports');
            if (!file_exists($exportsDir)) {
                mkdir($exportsDir, 0777, true);
            }

            array_unshift($dataExportSalesOutput, $headingsExportSales);
            array_unshift($dataExportServiceOutput, $headingsExportServices);
            
            $filenameTemplateSale = 'Tep_xuat_hoa_don_ban_hang_' . date('Ymd_His') . '.' . 'xlsx';
            $filePathTemplateSale = 'exports/' . $filenameTemplateSale;

            $filenameTemplateService = 'Tep_xuat_hoa_don_dich_vu' . date('Ymd_His') . '.' . 'xlsx';
            $filePathTemplateService = 'exports/' . $filenameTemplateService;

            Excel::store(new SimpleArrayExport($dataExportSalesOutput), $filePathTemplateSale, 'local');
            Excel::store(new SimpleArrayExport($dataExportServiceOutput), $filePathTemplateService, 'local');

            //ZIP
            $zipFileName = 'Tep_xuat_hoa_don_' . date('Ymd_His') . '.zip';
            $zipPath = storage_path('app/exports/' . $zipFileName);
            $fileToZip1 = $exportsDir . '/' . $filenameTemplateSale;
            $fileToZip2 = $exportsDir . '/' . $filenameTemplateService;
            $zip = new \ZipArchive;
            if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                $zip->addFile($fileToZip1, $filenameTemplateSale);
                $zip->addFile($fileToZip2, $filenameTemplateService);
                $zip->close();
            } else {
                throw new \Exception('Không thể tạo file');
           }

            Storage::delete($filePathTemplateSale);
            Storage::delete($filePathTemplateService);
            
            return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error data import',
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
