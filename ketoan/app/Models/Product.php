<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'market_code',
        'accounting_system_code',
        'product_name',
        'unit',
        'tax_rate',
        'combo_detail_code',
        'combo_name',
        'combo_unit',
        'quantity',
        'user_id',
    ];
}
