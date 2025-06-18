<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryExport extends Model
{
    use HasFactory;

    protected $table = 'history_export';
    public $timestamps = true;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'history_id';

    protected $fillable = [
        'history_id',
        'history_user_id',
        'order_code',
        'order_date',
        'order_total_amount',
        'order_vat_amount',
        'order_paid_amount',
        'order_export_receipt',
        'history_instance_id',
    ];
}
