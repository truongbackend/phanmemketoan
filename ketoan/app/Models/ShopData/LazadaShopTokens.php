<?php

namespace App\Models\ShopData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LazadaShopTokens extends Model
{
    use HasFactory;

    protected $table = 'lazada_shop_tokens';

    protected $fillable = [
        'access_token',
        'refresh_token',
        'account_platform',
        'account',
        'seller_id',
        'user_id',
        'country',
        'short_code',
        'expires_in',
        'refresh_expires_in',
        'code',
        'request_id',
        'trace_id',
    ];

}
