<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingAccountEcommerce extends Model
{
    protected $table = 'setting_account_ecommerce';
    protected $fillable = [
        'customer_code',
        'customer_name',
        'interpretation',
        'added_tax_vat',
        'warehouse',
        'account_capital_price',
        'account_warehouse',
        'payment_method',
        'user_id',
        'product_name_setting'
    ];
    protected $casts = [
        'interpretation'        => 'array',
        'product_name_setting'  => 'array',
    ];
}
