<?php

namespace App\Repositories;

use App\Models\Export\ExportReceiptViettelPost;
use Illuminate\Database\Eloquent\Collection; 

class ExportReceiptViettelPostRepository
{
    /**
     * Tạo mới một session export cho Viettel Post
     * @param array $data
     * @return ExportReceiptViettelPost
     */
    public function createExportSession($export_instance_id, $data_original = [], $data_case_normal = [], $export_data_case_exception = []): ExportReceiptViettelPost
    {
        $data = [
            'export_instance_id' => $export_instance_id,
            'export_data_orginal' => json_encode($data_original),
            'export_data_case_normal' => json_encode($data_case_normal),
            'export_data_case_exception' => json_encode($export_data_case_exception),
        ];
        dd(($data));
        return $this->create($data);
    }
    /**
     * Tạo mới một bản ghi ExportReceiptViettelPost
     * @param array $data
     * @return ExportReceiptViettelPost
     */
    public function create(array $data): ExportReceiptViettelPost
    {
        return ExportReceiptViettelPost::create($data);
    }
}