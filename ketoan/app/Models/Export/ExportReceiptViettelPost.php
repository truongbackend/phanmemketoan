<?php

namespace App\Models\Export;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportReceiptViettelPost extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'export_receipt_viettel_post'; // Tên bảng của bạn là 'export_data'

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'export_id'; // Khóa chính là 'export_id'

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true; // export_id là AUTO_INCREMENT

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int'; // Kiểu dữ liệu của khóa chính là int

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'export_instance_id',
        'export_data_orginal',
        'export_data_case_normal',
        'export_data_case_exception',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // Nếu các cột 'export_data_orginal', 'export_data_case_normal', 'export_data_case_1', 'export_data_case_2'
        // lưu trữ JSON hoặc các kiểu dữ liệu đặc biệt, bạn có thể định nghĩa cast ở đây.
        // Ví dụ: 'export_data_orginal' => 'array',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true; // Bật tự động quản lý created_at và updated_at

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';

}
