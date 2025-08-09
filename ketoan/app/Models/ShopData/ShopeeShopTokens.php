<?php

namespace App\Models\ShopData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeShopTokens extends Model
{
    use HasFactory;

    /**
     * Bảng cơ sở dữ liệu tương ứng
     */
    protected $table = 'shopee_shop_tokens';

    /**
     * Các cột cho phép gán hàng loạt
     */
    protected $fillable = [
        'auth_user_id',
        'shop_id',
        'access_token',
        'refresh_token',
        'expire_in',
        'request_id',
        'shop_name',
        'active',
    ];
}
