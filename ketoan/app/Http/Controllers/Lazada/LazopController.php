<?php

namespace App\Http\Controllers\Lazada;

use App\Http\Controllers\Controller;
use App\Models\SettingAccountEcommerce;
use Illuminate\Http\Request;
use App\Services\LazadaApiService;
use App\Services\ShopDataService;
use App\Services\ProductService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SimpleArrayExport;
use Illuminate\Support\Facades\Storage;

class LazopController extends Controller
{
    protected $lazadaApiService;
    protected $shopDataService;
    protected $productService;

    public function __construct(LazadaApiService $lazadaApiService, ShopDataService $shopDataService, ProductService $productService)
    {
        $this->lazadaApiService = $lazadaApiService;
        $this->shopDataService = $shopDataService;
        $this->productService = $productService;
    }

    private function responseApiLzd($data)
    {
        if (isset($data['code']) && $data['code'] != '0') {
            return response()->json([
                'status' => false,
                'code' => $data['code'],
                'message' => $data['message'] ?? 'Unknown error'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function getAuthShopUrl(Request $request)
    {
        $appKey = env('LAZOP_APP_KEY');
        $appSecret = env('LAZOP_APP_SECRET');
        $callbackUrl = env('LAZOP_CALLBACK_URL');
        if (!$appKey || !$appSecret) {
            return response()->json([
                'status' => false,
                'message' => 'Missing app_key or app_secret'
            ], 400);
        }

        $url = 'https://auth.lazada.com/oauth/authorize?response_type=code'
        . '&force_auth=true'
        . '&country=vn'
        . '&redirect_uri=' . urlencode($callbackUrl)
        . '&client_id=' . $appKey;

        return response()->json([
            'status' => true,
            'auth_url' => $url
        ]);
    }

    public function getShopAccessToken(Request $request)
    {
        try {
            $user = auth()->user();
            $userId = $user->id;
            $code = $request->input('code');
            $data = $this->lazadaApiService->getAccessToken($code, $userId);
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getShopRefreshtoken(Request $request)
    {
        try {
            $refreshToken = $request->input('refresh_token');
            $data = $this->lazadaApiService->refreshToken($refreshToken);
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function refreshTokenById(Request $request)
    {
        try {
            $user = auth()->user();
            $userId = $user->id;
            $tokenId = $request->input('token_id');

            if (!$tokenId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token ID là bắt buộc'
                ], 422);
            }

            $data = $this->lazadaApiService->refreshTokenAndUpdate($userId, $tokenId);

            if (isset($data['access_token'])) {
                return response()->json([
                    'status' => true,
                    'message' => 'Token đã được refresh thành công',
                    'data' => [
                        'access_token' => $data['access_token'],
                        'expires_in' => $data['expires_in'] ?? null,
                        'refresh_expires_in' => $data['refresh_expires_in'] ?? null,
                        'refresh_token' => $data['refresh_token'] ?? null
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Không thể refresh token',
                    'data' => $data
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deactivateToken(Request $request)
    {
        try {
            $user = auth()->user();
            $userId = $user->id;
            $tokenId = $request->input('token_id');

            if (!$tokenId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token ID là bắt buộc'
                ], 422);
            }

            $token = $this->shopDataService->deactivateLazadaShopToken($userId, $tokenId);

            return response()->json([
                'status' => true,
                'message' => 'Token đã được deactivate thành công',
                'data' => [
                    'id' => $token->id,
                    'account' => $token->account,
                    'active' => $token->active
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function pushReceipt(Request $request)
    {
        try {
            $user = auth()->user();
            $userId = $user->id;
            $userSettingEcommerce = SettingAccountEcommerce::where('user_id', $userId)->first();
            $userSettingEcommerceInterpretation = $userSettingEcommerce->interpretation;
            $userSettingEcommerceProductNameSetting = $userSettingEcommerce->product_name_setting;

            $createdBefore = $request->input('created_before');
            $createdAfter = $request->input('created_after');

            // Validate required
            if (!$createdBefore || !$createdAfter) {
                return response()->json([
                    'status' => false,
                    'message' => 'created_before và created_after là bắt buộc.'
                ], 422);
            }

            // Convert format dd/mm/yyyy => Y-m-d\TH:i:sP
            $from = \DateTime::createFromFormat('d/m/Y', $createdAfter);
            $to = \DateTime::createFromFormat('d/m/Y', $createdBefore);

            if (!$from || !$to) {
                return response()->json([
                    'status' => false,
                    'message' => 'Định dạng ngày tháng không hợp lệ. Định dạng đúng: dd/mm/yyyy'
                ], 422);
            }

            $from->modify('-3 days');
            $from->setTime(0, 0, 0);
            $to->setTime(23, 59, 59);

            $tz = '+07:00';
            $createdAfterIso = $from->format('Y-m-d\TH:i:s') . $tz;
            $createdBeforeIso = $to->format('Y-m-d\TH:i:s') . $tz;

            // Validate logic
            if ($to <= $from) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ngày bắt đầu phải lớn hơn ngày kết thúc.'
                ], 422);
            }

            $interval = $from->diff($to)->days;
            if ($interval > 30) {
                return response()->json([
                    'status' => false,
                    'message' => 'Khoảng thời gian không được lớn hơn 30 ngày.'
                ], 422);
            }

            // Prepare params
            $params = [
                'created_before' => $createdBeforeIso,
                'created_after' => $createdAfterIso,
                'sort_by' => 'updated_at',
                'sort_direction' => 'DESC',
                'offset' => $request->input('offset', 0),
                'limit' => $request->input('limit', 100),
                'status' => 'delivered',
            ];

            $accessToken = $this->shopDataService->getTokenByAuthUserId(auth()->user()->id);
            $LZDDataOrders= $this->lazadaApiService->getOrderList($accessToken, $params);

            // return response()->json([
            //     'status' => true,
            //     'data' => $LZDDataOrders
            // ]);

            if ($LZDDataOrders['code'] != '0') {
                return $this->responseApiLzd($LZDDataOrders);
            }

            $LZDDataOrders = $LZDDataOrders['data'] ?? [];
            $totalRecord = $LZDDataOrders['countTotal'] ?? 0;
            $totalInPage = $LZDDataOrders['count'] ?? 0;
            $LZDListOrder = $LZDDataOrders['orders'] ?? [];
            $listOrderOrderNumbers = ($totalInPage > 0) ? array_column($LZDListOrder, 'order_number') : [];

            $LZDDataOrderItems = [];

            if (!empty($listOrderOrderNumbers)) {
                $LZDDataOrderItems = $this->lazadaApiService->getOrderItemsByListID($accessToken, $listOrderOrderNumbers);

                if ($LZDDataOrderItems['code'] != '0') {
                    return $this->responseApiLzd($LZDDataOrderItems);
                }
            }

            $allSkus = $this->getAllSkus($LZDDataOrderItems);

            $skuValidation = $this->productService->validateSkus(array_column($allSkus, 'sku'));

            if (!$skuValidation['valid']) {
                return response()->json([
                    'status' => false,
                    'message' => $skuValidation['message'],
                    'missing_skus' => $skuValidation['missing_skus'],
                    'all_skus' => $allSkus
                ], 422);
            }

            $recordsSkuDetailPNL = $skuValidation['records'];

            $rowsItemCount = 0;
            $rowsItem = [];

            // return response()->json([
            //     'status' => true,
            //     'LZDListOrder' => $LZDListOrder,
            //     'LZDDataOrderItems' => $LZDDataOrderItems,
            //     'recordsSkuDetailPNL' => $recordsSkuDetailPNL,
            // ]);

            foreach ($LZDListOrder as $LZDOrder) {
                $orderNumber = $LZDOrder['order_number'] ?? $LZDOrder['order_id'];
                $orderCustomerFirstName = $LZDOrder['customer_first_name'] ?? "";
                $orderCustomerLastName = $LZDOrder['customer_last_name'] ?? "";
                $orderCustomerName = $orderCustomerFirstName . " " . $orderCustomerLastName;

                $packageId = null;
                $deliveredEventDateTime = null;

                $fillterdOrderItem = $this->getPackageIdAndDeliveredTime($orderNumber, $LZDDataOrderItems, $accessToken);
                $packageId = $fillterdOrderItem['package_id'];
                $deliveredEventDateTime = $fillterdOrderItem['delivered_time'];
                $deliveredEventDateTimeString = !empty($deliveredEventDateTime) ? date('Ymd', strtotime($deliveredEventDateTime)) : '';

                $TXTInterpretationOfOder = "";
                $firstOrderItem = $fillterdOrderItem['matching_order_item']['order_items'][0] ?? null;
                if ($firstOrderItem) {
                    $TXTInterpretationOfOder = $this->getInterpretationOfItem($orderNumber, $orderCustomerName, $firstOrderItem, $userSettingEcommerceInterpretation);
                }

                // Gộp các order item có cùng SKU và tính tổng số lượng
                $mergedOrderItems = [];
                foreach ($fillterdOrderItem['matching_order_item']['order_items'] as $orderItem) {
                    $sku = $orderItem['sku'];
                    if (!isset($mergedOrderItems[$sku])) {
                        $mergedOrderItems[$sku] = $orderItem;
                        $mergedOrderItems[$sku]['quantity'] = 1;
                        $mergedOrderItems[$sku]['total_voucher_seller'] = $orderItem['voucher_seller'];
                        $mergedOrderItems[$sku]['total_item_price'] = $orderItem['item_price'];
                    } else {
                        $mergedOrderItems[$sku]['quantity']++;
                        $mergedOrderItems[$sku]['total_voucher_seller'] += $orderItem['voucher_seller'];
                        $mergedOrderItems[$sku]['total_item_price'] += $orderItem['item_price'];
                    }
                }

                foreach ($mergedOrderItems as $orderItem) {
                    $skuOfOrderItem = $orderItem['sku'];
                    $recordSkuDetailPNL = array_filter($recordsSkuDetailPNL, function($record) use ($skuOfOrderItem) {
                        return $record['sku'] == $skuOfOrderItem;
                    });
                    $recordSkuDetailPNL = reset($recordSkuDetailPNL);
                    if(!empty($recordSkuDetailPNL['details'])){
                        $isCombo = true;
                    }else{
                        $isCombo = false;
                    }
                    
                    $revenueOfItem = $orderItem['total_item_price'] - $orderItem['total_voucher_seller'];
                    $unitPriceOfItem = $revenueOfItem / $orderItem['quantity'] / (1 + $recordSkuDetailPNL['tax_rate'] / 100);
                    $totalAmountOfItem = $unitPriceOfItem * $orderItem['quantity'];
                    $calTaxAmountOfItem = $revenueOfItem - $totalAmountOfItem;

                    $isProductDiscount = "";
                    if($totalAmountOfItem  > 0){
                        $isProductDiscount = "Không";
                    }else if($totalAmountOfItem == 0){
                        $isProductDiscount = "Có";
                    }

                    $rowsItem[] = [
                        "A" => "Bán hàng hóa trong nước",
                        "B" => "Chưa thu tiền",
                        "C" => "Có",
                        "D" => "Có",
                        "E" => "Đã lập",
                        "F" => $deliveredEventDateTimeString,
                        "G" => $deliveredEventDateTimeString,
                        "H" => !empty($userSettingEcommerce->document_number_prefix) ? $userSettingEcommerce->document_number_prefix . $orderNumber : $orderNumber,
                        "I" => !empty($userSettingEcommerce->issue_voucher_prefix) ? $userSettingEcommerce->issue_voucher_prefix . $deliveredEventDateTimeString . str_pad($rowsItemCount + 1, 4, '0', STR_PAD_LEFT) : $orderNumber,
                        "J" => "",
                        "K" => "",
                        "L" => "",
                        "M" => $deliveredEventDateTimeString,
                        "N" => !empty($userSettingEcommerce->customer_code) ? $userSettingEcommerce->customer_code : "",
                        "O" => $orderCustomerName,
                        "P" => "",
                        "Q" => "",
                        "R" => "",
                        "S" => "",
                        "T" => "",
                        "U" => "",
                        "V" => $TXTInterpretationOfOder,
                        "W" => $TXTInterpretationOfOder,
                        "X" => "",
                        "Y" => "",
                        "Z" => "",
                        "AA" => "",
                        "AB" => "VND",
                        "AC" => "",
                        "AD" => $skuOfOrderItem,
                        "AE" => "",
                        "AF" => $this->getAFColumnContent($orderNumber, $orderItem, $userSettingEcommerceProductNameSetting),
                        "AG" => "Không",
                        "AH" => $isProductDiscount,
                        "AI" => $userSettingEcommerce->account_cash_debt,
                        "AJ" => $userSettingEcommerce->account_revenue,
                        "AK" => $recordSkuDetailPNL['unit'],
                        "AL" => $orderItem['quantity'],
                        "AM" => $unitPriceOfItem,
                        "AN" => $totalAmountOfItem,
                        "AO" => "",
                        "AP" => "",
                        "AQ" => "",
                        "AR" => "",
                        "AS" => "",
                        "AT" => "",
                        "AU" => "",
                        "AV" => "",
                        "AW" => "",
                        "AX" => $recordSkuDetailPNL['tax_rate'],
                        "AY" => "",
                        "AZ" => $calTaxAmountOfItem,
                        "BA" => "",
                        "BB" => $userSettingEcommerce->added_tax_vat,
                        "BC" => "Không",
                        "BD" => "",
                        "BE" => "",
                        "BF" => "",
                        "BG" => "",
                        "BH" => "",
                        "BI" => "",
                        "BJ" => "",
                        "BK" => "",
                        "BL" => "Không",
                        "BM" => $userSettingEcommerce->warehouse,
                        "BN" => $userSettingEcommerce->account_capital_price,
                        "BO" => $userSettingEcommerce->account_warehouse,
                        "BP" => "",
                        "BQ" => "",
                        "BR" => "",
                        "BS" => $this->getPaymentMethod($userSettingEcommerce->payment_method),
                        "BT" => "Có",
                        "BU" => $deliveredEventDateTimeString,
                        "BV" => $orderNumber,
                        "BW" => $skuOfOrderItem,
                        "BX" => $totalAmountOfItem + $calTaxAmountOfItem,
                    ];

                    $rowsItemOther[] = [
                        "A" => $deliveredEventDateTimeString,
                        "B" => $deliveredEventDateTimeString,
                        "C" => !empty($userSettingEcommerce->document_number_prefix) ? $userSettingEcommerce->document_number_prefix . $orderNumber : $orderNumber,
                        "D" => "LZD thu hộ công nợ khách lẻ-Số đơn hàng: " . $orderNumber . "/LZD get payment on behalf from retail clients",
                        "E" => "VND",
                        "F" => "",
                        "G" => "LZD thu hộ công nợ khách lẻ-Số đơn hàng: " . $orderNumber . "/LZD get payment on behalf from retail clients",
                        "H" => $userSettingEcommerce->account_cash_debt,
                        "I" => $userSettingEcommerce->account_revenue,
                        "J" => $revenueOfItem,
                        "K" => "",
                        "L" => "",
                        "M" => !empty($userSettingEcommerce->customer_code) ? $userSettingEcommerce->customer_code : "",
                        "N" => "Không",
                        "O" => "",
                        "P" => "",
                        "Q" => "",
                        "R" => "",
                        "S" => "",
                        "T" => "",
                        "U" => "",
                        "V" => "",
                        "W" => "",
                        "X" => "",
                        "Y" => "",
                        "Z" => "",
                        "AA" => "",
                        "AB" => "",
                        "AC" => "",
                        "AD" => "",
                        "AE" => $orderNumber,
                    ];
                
                    if($isCombo){
                        foreach($recordSkuDetailPNL['details'] as $comboDetail){
                            $rowsItem[] = [
                                "A" => "Bán hàng hóa trong nước",
                                "B" => "Chưa thu tiền",
                                "C" => "Có",
                                "D" => "Có",
                                "E" => "Đã lập",
                                "F" => $deliveredEventDateTimeString,
                                "G" => $deliveredEventDateTimeString,
                                "H" => !empty($userSettingEcommerce->document_number_prefix) ? $userSettingEcommerce->document_number_prefix . $orderNumber : $orderNumber,
                                "I" => !empty($userSettingEcommerce->issue_voucher_prefix) ? $userSettingEcommerce->issue_voucher_prefix . $deliveredEventDateTimeString . str_pad($rowsItemCount + 1, 4, '0', STR_PAD_LEFT) : $orderNumber,
                                "J" => "",
                                "K" => "",
                                "L" => "",
                                "M" => $deliveredEventDateTimeString,
                                "N" => !empty($userSettingEcommerce->customer_code) ? $userSettingEcommerce->customer_code : "",
                                "O" => $orderCustomerName,
                                "P" => "",
                                "Q" => "",
                                "R" => "",
                                "S" => "",
                                "T" => "",
                                "U" => "",
                                "V" => $TXTInterpretationOfOder,
                                "W" => $TXTInterpretationOfOder,
                                "X" => "",
                                "Y" => "",
                                "Z" => "",
                                "AA" => "",
                                "AB" => "VND",
                                "AC" => "",
                                "AD" => $comboDetail['combo_detail_code'],
                                "AE" => $skuOfOrderItem,
                                "AF" => $this->getAFColumnContent($orderNumber, $orderItem, $userSettingEcommerceProductNameSetting),
                                "AG" => "",
                                "AH" => "",
                                "AI" => "",
                                "AJ" => "",
                                "AK" => $comboDetail['unit'],
                                "AL" => $comboDetail['quantity'],
                                "AM" => "",
                                "AN" => "",
                                "AO" => "",
                                "AP" => "",
                                "AQ" => "",
                                "AR" => "",
                                "AS" => "",
                                "AT" => "",
                                "AU" => "",
                                "AV" => "",
                                "AW" => "",
                                "AX" => "",
                                "AY" => "",
                                "AZ" => "",
                                "BA" => "",
                                "BB" => "",
                                "BC" => "Không",
                                "BD" => "",
                                "BE" => "",
                                "BF" => "",
                                "BG" => "",
                                "BH" => "",
                                "BI" => "",
                                "BJ" => "",
                                "BK" => "",
                                "BL" => "Không",
                                "BM" => $userSettingEcommerce->warehouse,
                                "BN" => $userSettingEcommerce->account_capital_price,
                                "BO" => $userSettingEcommerce->account_warehouse,
                                "BP" => "",
                                "BQ" => "",
                                "BR" => "",
                                "BS" => $this->getPaymentMethod($userSettingEcommerce->payment_method),
                                "BT" => "Có",
                                "BU" => $deliveredEventDateTimeString,
                                "BV" => $orderNumber,
                                "BW" => $skuOfOrderItem,
                                "BX" => "0",
                            ];
                        }
                    }
                }
            }
            
            $dataExportService = new \App\Services\DataExportService();
            $headingsExportLazada  = $dataExportService->getExportHead('lazada');
            $headingsExportLazadaOther  = $dataExportService->getExportHead('lazada_other');

            $exportsDir = storage_path('app/exports');
            if (!file_exists($exportsDir)) {
                mkdir($exportsDir, 0777, true);
            }

            array_unshift($rowsItem, $headingsExportLazada);
            $filenameTemplateLazada = 'ban_hang_lazada_' . date('Ymd_His') . '.' . 'xlsx';
            $filePathTemplateLazada = 'exports/' . $filenameTemplateLazada;
            Excel::store(new SimpleArrayExport($rowsItem), $filePathTemplateLazada, 'local');

            array_unshift($rowsItemOther, $headingsExportLazadaOther);
            $filenameTemplateLazadaOther = 'ban_hang_lazada_nghiep_vu_khac_' . date('Ymd_His') . '.' . 'xlsx';
            $filePathTemplateLazadaOther = 'exports/' . $filenameTemplateLazadaOther;
            Excel::store(new SimpleArrayExport($rowsItemOther), $filePathTemplateLazadaOther, 'local');

            //ZIP
            $zipFileName = 'export_lazada_' . date('Ymd_His') . '.zip';
            $zipPath = storage_path('app/exports/' . $zipFileName);
            $fileToZip1 = $exportsDir . '/' . $filenameTemplateLazada;
            $fileToZip2 = $exportsDir . '/' . $filenameTemplateLazadaOther;
            $zip = new \ZipArchive;
            if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                $zip->addFile($fileToZip1, $filenameTemplateLazada);
                $zip->addFile($fileToZip2, $filenameTemplateLazadaOther);
                $zip->close();
            } else {
                throw new \Exception('Không thể tạo file');
            }

            Storage::delete($filePathTemplateLazada);

            return response()->download($zipPath, $zipFileName);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => '0',
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkAuthShopStatus(Request $request)
    {
        try {
            $user = auth()->user();
            $userId = $user->id;

            $status = $this->shopDataService->checkAuthShopStatus($userId);

            return response()->json([
                'status' => true,
                'data' => $status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getPackageIdAndDeliveredTime($orderNumber, $LZDDataOrderItems, $accessToken)
    {
        $result = [
            'package_id' => null,
            'delivered_time' => null,
            'matching_order_item' => null
        ];

        $matchingOrderItem = array_filter($LZDDataOrderItems['data'], function($orderItem) use ($orderNumber) {
            return ($orderItem['order_number'] == $orderNumber) || ($orderItem['order_id'] == $orderNumber);
        });

        if (!empty($matchingOrderItem)) {
            $firstMatch = reset($matchingOrderItem);
            if (!empty($firstMatch['order_items']) && isset($firstMatch['order_items'][0]['package_id'])) {
                $result['package_id'] = $firstMatch['order_items'][0]['package_id'];
                $result['matching_order_item'] = $firstMatch;
                $orderTrace = $this->lazadaApiService->getOrderTraceByPackageId($accessToken, $orderNumber, $result['package_id']);

                if (isset($orderTrace['result']['module'][0]['package_detail_info_list'][0]['logistic_detail_info_list'])) {
                    $logisticDetails = $orderTrace['result']['module'][0]['package_detail_info_list'][0]['logistic_detail_info_list'];

                    foreach ($logisticDetails as $detail) {
                        if (isset($detail['detail_type']) && $detail['detail_type'] === 'delivered') {
                            if (isset($detail['event_time'])) {
                                $timestamp = $detail['event_time'] / 1000;
                                $result['delivered_time'] = date('Y-m-d H:i:s', $timestamp + (7 * 3600));
                            }
                            break;
                        }
                    }
                }
            }
        }

        return $result;
    }

    private function getInterpretationOfItem($orderNumber, $orderCustomerName, $orderItem, $userSettingEcommerceInterpretation)
    {
        $parts = [];
        $prefix = "Xuất BH-";

        if (in_array("1", $userSettingEcommerceInterpretation)) {
            $parts[] = $orderCustomerName;
        }

        if (in_array("2", $userSettingEcommerceInterpretation)) {
            $parts[] = "Số đơn hàng: " . $orderNumber;
        }

        if (in_array("3", $userSettingEcommerceInterpretation)) {
            $parts[] = $orderItem['name'];
        }

        $interpretation = $prefix . " " . implode(". ", $parts);

        if (strlen($interpretation) > 255) {
            $interpretation = substr($interpretation, 0, 252);
        }

        return $interpretation;
    }

    private function getPaymentMethod($method_id)
    {
        $paymentMethod = "";
        if($method_id == 1){
            $paymentMethod = "TM/CK";
        }else if($method_id == 2){
            $paymentMethod = "Chuyển khoản";
        }else if($method_id == 3){
            $paymentMethod = "Tiền mặt";
        }
        
        return $paymentMethod;
    }

    private function getAFColumnContent($orderNumber, $orderItem, $userSettingEcommerceProductNameSetting)
    {
        $parts = [];

        if (in_array("1", $userSettingEcommerceProductNameSetting)) {
            $parts[] =  $orderNumber;
        }

        if (in_array("2", $userSettingEcommerceProductNameSetting)) {
            $parts[] = $orderItem['name'];
        }

        return implode(". ", $parts);
    }

    private function getAllSkus($LZDDataOrderItems)
    {
        if (!isset($LZDDataOrderItems['data']) || !is_array($LZDDataOrderItems['data'])) {
            return [];
        }

        $skuNameMap = array_reduce($LZDDataOrderItems['data'], function($carry, $orderData) {
            if (!isset($orderData['order_items']) || !is_array($orderData['order_items'])) {
                return $carry;
            }

            foreach ($orderData['order_items'] as $orderItem) {
                if (isset($orderItem['sku']) && !empty($orderItem['sku'])) {
                    $sku = $orderItem['sku'];
                    $name = $orderItem['name'] ?? '';
                    
                    if (!isset($carry[$sku]) || strlen($name) > strlen($carry[$sku])) {
                        $carry[$sku] = $name;
                    }
                }
            }
            
            return $carry;
        }, []);

        return array_values(array_map(function($sku, $name) {
            return ['sku' => $sku, 'name' => $name];
        }, array_keys($skuNameMap), $skuNameMap));
    }


}
