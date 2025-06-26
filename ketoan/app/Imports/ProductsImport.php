<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements ToCollection, WithStartRow
{
    private $userId;

    public function __construct()
    {
        $this->userId = auth()->id();
    }

    /**
     * Dữ liệu sẽ được đọc bắt đầu từ dòng số 2.
     * Dòng 1 có thể là tiêu đề hoặc để trống, nó sẽ bị bỏ qua.
     */
    public function startRow(): int
    {
         return 3;
    }

    /**
     * Xử lý collection các hàng từ file Excel bằng chỉ số cột.
     *
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        // Định nghĩa thứ tự các cột để dễ quản lý
        // QUAN TRỌNG: Thứ tự này PHẢI KHỚP với file Excel của bạn
        $colMap = [
            'sku'             => 0, // Cột A
            'accounting_code' => 1, // Cột B
            'product_name'    => 2, // Cột C
            'product_unit'    => 3, // Cột D
            'tax_rate'        => 4, // Cột E
            'combo_code'      => 5, // Cột F
            'combo_name'      => 6, // Cột G
            'combo_unit'      => 7, // Cột H
            'combo_quantity'  => 8, // Cột I
        ];

        foreach ($rows as $row) {
            // Chuyển đổi thành mảng để kiểm tra rỗng dễ dàng hơn
            $rowData = $row->toArray();
            if (empty(array_filter($rowData))) {
                continue; // Bỏ qua nếu cả hàng đều trống
            }

            // Lấy dữ liệu bằng chỉ số đã định nghĩa
            $sku  = trim($row[$colMap['sku']] ?? '');
            $code = trim($row[$colMap['accounting_code']] ?? '');
            $name = trim($row[$colMap['product_name']] ?? '');

            // Bỏ qua hàng nếu thiếu thông tin cơ bản
            if (empty($sku) || empty($code) || empty($name)) {
                continue;
            }

            // Tìm hoặc tạo mới sản phẩm
            $product = Product::firstOrCreate(
                [
                    'sku'             => $sku,
                    'accounting_code' => $code,
                ],
                [
                    'product_name'    => $name,
                    'unit'            => trim($row[$colMap['product_unit']] ?? ''),
                    'tax_rate'        => $row[$colMap['tax_rate']] ?? 0,
                    'product_user_id'         => $this->userId,
                ]
            );

            // Xử lý chi tiết combo nếu có
            $comboCode = trim($row[$colMap['combo_code']] ?? '');
            if (!empty($comboCode)) {
                $product->details()->firstOrCreate(
                    [
                        'combo_detail_code' => $comboCode,
                    ],
                    [
                        'detail_name'       => trim($row[$colMap['combo_name']] ?? ''),
                        'unit'              => trim($row[$colMap['combo_unit']] ?? ''),
                        'quantity'          => $row[$colMap['combo_quantity']] ?? 1,
                    ]
                );
            }
        }
    }
}
