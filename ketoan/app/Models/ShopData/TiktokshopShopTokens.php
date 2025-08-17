<?php

namespace App\Models\ShopData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiktokshopShopTokens extends Model
{
    use HasFactory;

    protected $table = 'tiktokshop_shop_tokens';

    protected $fillable = [
        'auth_user_id',
        'access_token',
        'access_token_expire_in',
        'refresh_token_expire_in',
        'refresh_token',
        'open_id',
        'seller_name',
        'seller_base_region',
        'user_type',
        'granted_scopes',
        'active',
    ];
}
