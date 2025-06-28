<?php

namespace App\Repositories;

use App\Models\ShopData\LazadaShopTokens;

class ShopDataRepository
{
    public function findBySellerId($sellerId)
    {
        return LazadaShopTokens::where('seller_id', $sellerId)->first();
    }

    public function findByUserId($userId)
    {
        return LazadaShopTokens::where('user_id', $userId)->first();
    }

    public function findByAuthUserId($userId)
    {
        return LazadaShopTokens::where('auth_user_id', $userId)->first();
    }

    public function createOrUpdateBySellerId($data)
    {
        return LazadaShopTokens::updateOrCreate(
            ['seller_id' => $data['seller_id']],
            $data
        );
    }
}