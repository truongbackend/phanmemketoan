<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingAccountLazada extends Model
{
    protected $table = 'setting_account_lazada';

    protected $fillable = [
        'shop_id',
        'type',
        'document_number_prefix',
        'issue_voucher_prefix',
        'account_cash_debt',
        'account_revenue',
        'user_id'
    ];
    public function shop()
    {
        return $this->belongsTo(SettingAccountEcommerce::class, 'shop_id');
    }

}
