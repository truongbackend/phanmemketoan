<?php

namespace App\Services;

// use App\Repositories\Currency\CurrencyInterface;

class DataExportService
{
    // protected $currencyRepository;

    // public function __construct(CurrencyInterface $currencyRepository)
    // {
    //     $this->currencyRepository = $currencyRepository;
    // }

    /**
     * Trả về mảng head cho xuất file xls theo loại: ban hang hoặc dich vu
     * @param string $type
     * @return array
     */
    public function getExportHead($type = 'sales')
    {
        $heads = config('heading_row');
        return $heads[$type] ?? [];
    }

    public function exportTemplateSales($dataInput, $dataSetting, $productsOfPushSaleProduct){
        try {
            $pushSaleItem = $dataInput['push_sale_details'] ?? [];
            $manyRecordPushSale = count($pushSaleItem) !== 1;
            $pushSalesFirstItem = $pushSaleItem[0] ?? [];
            
            $rowsItem = [];
            foreach ($pushSaleItem as $indexPushSaleItem => $pushSaleItemDetail) {
                //
                $posting_date = "";
                if($dataSetting['posting_date'] == 1){
                    if (!empty($dataInput[42])) {
                        $dateObj = \DateTime::createFromFormat('d/m/Y H:i:s', $dataInput[42]);
                        if ($dateObj) {
                            $posting_date = $dateObj->format('d/m/Y');
                        }
                    }
                } else {
                    $posting_date = now()->format('d/m/Y');
                }

                //
                $export_receipt_number = $dataSetting['export_receipt_number'] ?? '';

                if(empty($export_receipt_number)){
                    $export_receipt_number = now()->format('ymd');
                }else{
                    $serial = str_pad($indexPushSaleItem + 1, 4, '0', STR_PAD_LEFT);
                    $export_receipt_number = $export_receipt_number . now()->format('ymd') . $serial;
                }

                //
                $value_submit_reason = "";
                $col_submit_reason_config = config('col_submit_reason.viettel_post');
                $col_submit_reason_setting = $dataSetting['submission_reason'] ?? [];
                foreach ($col_submit_reason_setting as $key => $value) {
                    if (isset($col_submit_reason_config[$value])) {
                        $col_submit_reason_get = $col_submit_reason_config[$value];
                        if($col_submit_reason_get['file'] == 'push_sales'){
                            if(isset($col_submit_reason_get['get_parent'])){
                                $value_submit_reason .= $pushSalesFirstItem[$col_submit_reason_get['index']] ?? '';
                            } else {
                                $value_submit_reason .= $pushSaleItemDetail[$col_submit_reason_get['index']] ?? '';
                            }
                        } 
                    }
                }

                //
                $productCodeOFPushSaleItem = $pushSaleItemDetail[4];

                $filteredProductOFPushSaleItem = collect($productsOfPushSaleProduct)->filter(function ($item) use ($productCodeOFPushSaleItem) {
                                                    return $item[0] === $productCodeOFPushSaleItem; 
                                                });
                
                if($filteredProductOFPushSaleItem->isEmpty()){
                    return [
                        "status" => false,
                        "message" => "Mã hàng hóa " .$productCodeOFPushSaleItem. " không tồn tại trong danh sách hàng hóa"
                    ];
                }

                $combo = false;
                if($filteredProductOFPushSaleItem->count() > 1 && !empty($filteredProductOFPushSaleItem[0][5])){
                    $combo = true;
                }

                $rowProductName = "";
                $triggerProductNameTrigger = $dataSetting['trigger_product_name'];

                if($triggerProductNameTrigger == 1){
                    $rowProductName = $filteredProductOFPushSaleItem->first()[2];
                } else if($triggerProductNameTrigger == 2){
                    $rowProductName = $pushSaleItemDetail[3];
                }

                $arrDataGenerateOrderPricingSummary = [
                    'order_code' => $dataInput[2],
                    'order_total_amount' => $pushSalesFirstItem[11],
                    'order_total_discount' => $pushSalesFirstItem[9],
                    'order_cod_amount' => empty($pushSalesFirstItem[10]) ? 0 : $pushSalesFirstItem[10],
                    'product_item' => [
                        'product_code' => $pushSaleItemDetail[4],
                        'tax_fee' => empty($filteredProductOFPushSaleItem->first()[4]) ? 0 : $filteredProductOFPushSaleItem->first()[4],
                        'product_quantity' => $pushSaleItemDetail[6],
                        'product_unit_price' => $pushSaleItemDetail[7],
                    ]
                ];

                $pricingSummary = $this->generateOrderPricingSummary($arrDataGenerateOrderPricingSummary, $manyRecordPushSale);

                $bonus_product = "";

                if($pushSaleItemDetail[6] * $pricingSummary['unit_price'] = 0){
                    $bonus_product = "Có";
                }
                if ($pushSaleItemDetail[6] * $pricingSummary['unit_price'] > 0){
                    $bonus_product = "Không";
                }


                $rowsItem[] = [
                    "A" => "Bán hàng hóa trong nước",
                    "B" => "Chưa thu tiền",
                    "C" => "Có",
                    "D" => "Có",
                    "E" => "Đã lập",
                    "F" => "Có",
                    "G" => $posting_date,
                    "H" => $posting_date,
                    "I" => $pushSaleItemDetail[2],
                    "J" => $export_receipt_number,
                    "K" => "",
                    "L" => "",
                    "M" => "",
                    "N" => $posting_date,
                    "O" => $dataSetting['customer_code'] ?? '',
                    "P" => $pushSalesFirstItem[13],
                    "Q" => "",
                    "R" => "",
                    "S" => "",
                    "T" => "",
                    "U" => "",
                    "V" => $value_submit_reason,
                    "W" => $value_submit_reason,
                    "X" => "",
                    "Y" => "",
                    "Z" => "",
                    "AA" => "",
                    "AB" => "VND",
                    "AC" => "TM/CK",
                    "AD" => "",
                    "AE" => $filteredProductOFPushSaleItem->first()[1],
                    "AF" => "",
                    "AG" => $rowProductName,
                    "AH" => "",
                    "AI" => $bonus_product,
                    "AJ" => $dataSetting['account_cash_expense_debt'] ?? '',
                    "AK" => $dataSetting['account_revenue_credit'] ?? '',
                    "AL" => $filteredProductOFPushSaleItem->first()[3],
                    "AM" => $pushSaleItemDetail[6],
                    "AN" => $pricingSummary['unit_price'],
                    "AO" => $pushSaleItemDetail[6] * $pricingSummary['unit_price'],
                    "AP" => "",
                    "AQ" => "",
                    "AR" => "",
                    "AS" => "",
                    "AT" => "",
                    "AU" => "",
                    "AV" => "",
                    "AW" => "",
                    "AX" => "",
                    "AY" => $filteredProductOFPushSaleItem->first()[4],
                    "AZ" => "",
                    "BA" => $pricingSummary['tax_amount'],
                    "BB" => "",
                    "BC" => $dataSetting['account_vat_tax'] ?? '',
                    "BD" => "Không",
                    "BE" => "",
                    "BF" => "",
                    "BG" => "",
                    "BH" => "",
                    "BI" => "",
                    "BJ" => "",
                    "BK" => "", 
                    "BL" => "",
                    "BM" => $dataSetting['warehouse_code'] ?? '',
                    "BN" => $dataSetting['account_cost_of_goods_sold'] ?? '',
                    "BO" => $dataSetting['account_inventory'] ?? '',
                    "BP" => "",
                    "BQ" => "",
                    "BR" => "",
                    "BS" => "Không chọn",
                    "BT" => $pushSaleItemDetail[6] * $pricingSummary['unit_price'] + $pricingSummary['tax_amount'],
                ];   
                
                if($combo){
                    foreach ($filteredProductOFPushSaleItem as $indexFilteredProductOFPushSaleItem => $filteredProductOFPushSaleItemDetail) {
                        $triggerProductNameTrigger = $dataSetting['trigger_product_name'];

                        $rowsItem[] = [
                            "A" => "Bán hàng hóa trong nước",
                            "B" => "Chưa thu tiền",
                            "C" => "Có",
                            "D" => "Có",
                            "E" => "Đã lập",
                            "F" => "Có",
                            "G" => $posting_date,
                            "H" => $posting_date,
                            "I" => $pushSaleItemDetail[2],
                            "J" => $export_receipt_number,
                            "K" => "",
                            "L" => "",
                            "M" => "",
                            "N" => $posting_date,
                            "O" => $dataSetting['customer_code'] ?? '',
                            "P" => $pushSalesFirstItem[13],
                            "Q" => "",
                            "R" => "",
                            "S" => "",
                            "T" => "",
                            "U" => "",
                            "V" => $value_submit_reason,
                            "W" => $value_submit_reason,
                            "X" => "",
                            "Y" => "",
                            "Z" => "",
                            "AA" => "",
                            "AB" => "VND",
                            "AC" => "TM/CK",
                            "AD" => "",
                            "AE" => $filteredProductOFPushSaleItemDetail[5],
                            "AF" => $filteredProductOFPushSaleItemDetail[1],
                            "AG" => $filteredProductOFPushSaleItemDetail[6],
                            "AH" => "",
                            "AI" => "",
                            "AJ" => $dataSetting['account_cash_expense_debt'] ?? '',
                            "AK" => $dataSetting['account_revenue_credit'] ?? '',
                            "AL" => $filteredProductOFPushSaleItemDetail[3],
                            "AM" => $pushSaleItemDetail[6],
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
                            "AY" => $filteredProductOFPushSaleItemDetail[4],
                            "AZ" => "",
                            "BA" => "",
                            "BB" => "",
                            "BC" => $dataSetting['account_vat_tax'] ?? '',
                            "BD" => "Không",
                            "BE" => "",
                            "BF" => "",
                            "BG" => "",
                            "BH" => "",
                            "BI" => "",
                            "BJ" => "",
                            "BK" => "", 
                            "BL" => "",
                            "BM" => $dataSetting['warehouse_code'] ?? '',
                            "BN" => $dataSetting['account_cost_of_goods_sold'] ?? '',
                            "BO" => $dataSetting['account_inventory'] ?? '',
                            "BP" => "",
                            "BQ" => "",
                            "BR" => "",
                            "BS" => "Không chọn",
                            "BT" => "",
                        ];   
                    }
                }
            }
            
            return [
                "status" => true,
                "data" => $rowsItem
            ];
        }catch (\Exception $e) {
            dd($e->getMessage(), $dataInput);
            return [
                "status" => false,
                "message" => "Lỗi khi xuất file: " . $e->getMessage()
            ];
        }
    }

    public function exportTemplateServices($dataInput, $dataSetting){
        $rowsDataExport = [];

        foreach ($dataInput as $keyInput => $itemInput) {
            $pushSaleItem = $itemInput['push_sale_details'] ?? [];

            if(empty($pushSaleItem)) continue;
            
            $pushSalesFirstItem = $pushSaleItem[0] ?? [];

            if(empty($pushSalesFirstItem)) continue;

            $is_discounted_item = "Không";

            if($pushSalesFirstItem[8] == 0 || empty($pushSalesFirstItem[8])){
                $is_discounted_item = "Có";
            }

            foreach ($pushSaleItem as $indexPushSaleItem => $pushSaleItemDetail) {
                $rowsItem = [
                                "A" => "Bán hàng hóa trong nước",
                                "B" => "Chưa thu tiền",
                                "C" => "Có",
                                "D" => "Có",
                                "E" => "Đã lập",
                                "F" => "Có",
                                "G" => "????",
                                "H" => "????",
                                "I" => $pushSaleItemDetail[2],
                                "J" => "???? tinh toan",
                                "K" => "",
                                "L" => "",
                                "M" => "",
                                "N" => "????",
                                "O" => "????",
                                "P" => $pushSalesFirstItem[13],
                                "Q" => "",
                                "R" => "",
                                "S" => "",
                                "T" => "",
                                "U" => "",
                                "V" => "????",
                                "W" => "????",
                                "X" => "",
                                "Y" => "",
                                "Z" => "",
                                "AA" => "",
                                "AB" => "VND",
                                "AC" => "TM/CK",
                                "AD" => "",
                                "AE" => "????",
                                "AF" => "????",
                                "AG" => "????",
                                "AH" => "",
                                "AI" => $is_discounted_item,
                                "AJ" => "???? input",
                                "AK" => "???? input",
                                "AL" => "????",
                                "AM" => $pushSalesFirstItem[6],
                                "AN" => "???? tinh toan",
                                "AO" => "????",
                                "AP" => "",
                                "AQ" => "",
                                "AR" => "",
                                "AS" => "",
                                "AT" => "",
                                "AU" => "",
                                "AV" => "",
                                "AW" => "",
                                "AX" => "",
                                "AY" => "????",
                                "AZ" => "",
                                "BA" => "???? tinh toan sheet 2",
                                "BB" => "",
                                "BC" => "???? input",
                                "BD" => "Không",
                                "BE" => "",
                                "BF" => "",
                                "BG" => "",
                                "BH" => "",
                                "BI" => "",
                                "BJ" => "",
                                "BK" => "", 
                                "BL" => "",
                                "BM" => "???? input",
                                "BN" => "???? input",
                                "BO" => "???? input",
                                "BP" => "",
                                "BQ" => "",
                                "BR" => "",
                                "BS" => "Không chọn",
                                "BT" => "???? tinh toan AO + BA",
                            ];
            }
        }
    }

    public function getColumnSubmitReason($arr_key)
    {
        $col_submit_reason = config('col_submit_reason.viettel_post');
        if (isset($col_submit_reason[$arr_key])) {
            return $col_submit_reason[$arr_key];
        }
        return null;

    }

    public function generateOrderPricingSummary($productOrder, $manyProduct = false){
        try{
             $revenue = 0;
            $unit_price = 0;
            $subtotal_amount = 0;
            $tax_amount = 0;

            $productItem = $productOrder['product_item'];

            if (!is_numeric($productOrder['order_cod_amount'])) {
                $productOrder['order_cod_amount'] = 0;
            }

            if (!is_numeric($productOrder['order_total_discount'])) {
                $productOrder['order_total_discount'] = 0;
            }

            if(!$manyProduct){
                $revenue = $productItem['product_quantity'] * $productItem['product_unit_price'] -
                            $productOrder['order_total_discount'] + 
                            $productOrder['order_cod_amount'];
                
                $unit_price = $revenue / $productItem['product_quantity'] / (1 + $productItem['tax_fee'] / 100);
                
                $unit_price = round($unit_price);

                $subtotal_amount = $unit_price * $productItem['product_quantity'];
                $tax_amount = $revenue - $subtotal_amount;
            }else{
                $orderTotal = $productOrder['order_total_amount'];

                $ratio = $productItem['product_unit_price'] / $orderTotal;

                $productOrder['product_item']['discount_allocation_percent'] = $ratio;
                $productOrder['product_item']['discount_allocation'] = $productOrder['order_total_discount'] * $ratio;
                $productOrder['product_item']['cod_allocation_percent'] = $ratio;

                $productOrder['product_item']['cod_allocation'] = $productOrder['order_cod_amount'] * $ratio;
                $revenue = $productItem['product_unit_price'] * $productItem['product_quantity'] -
                            $productOrder['product_item']['discount_allocation'] + 
                            $productOrder['product_item']['cod_allocation'];

                $unit_price = $revenue / $productItem['product_quantity'] / (1 + $productItem['tax_fee'] / 100);
                $unit_price = round($unit_price);

                $subtotal_amount = $unit_price * $productItem['product_quantity'];
                $tax_amount = $revenue - $subtotal_amount;
            }

            return [
                'revenue' => $revenue,
                'unit_price' => $unit_price,
                'subtotal_amount' =>    $subtotal_amount,
                'tax_amount' => $tax_amount,
            ];
        }catch (\Exception $e) {
            dd($e);
            return [
                "status" => false,
                "message" => "Lỗi khi xuất file: " . $e->getMessage()
            ];
        }
    }
}
