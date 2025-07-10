<?php

namespace App\Repositories;

use App\Models\ShopData\LazadaShopTokens;
use Carbon\Carbon;

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

    public function findByAuthUserIdAndId($authUserId, $id)
    {
        return LazadaShopTokens::where('auth_user_id', $authUserId)
                               ->where('id', $id)
                               ->first();
    }

    public function createOrUpdateBySellerId($data)
    {
        return LazadaShopTokens::updateOrCreate(
            [
                'auth_user_id' => $data['auth_user_id'],
                'account' => $data['account'],
            ],
            $data
        );
    }

    public function checkAuthShopStatus($authUserId)
    {
        $tokens = LazadaShopTokens::where('auth_user_id', $authUserId)->get();
        
        $verifiedAccounts = [];
        
        foreach ($tokens as $token) {
            $createdAt = Carbon::parse($token->updated_at);
            $expiresAt = $createdAt->addSeconds($token->expires_in);
            $now = Carbon::now();
            
            $isExpired = $now->gt($expiresAt);
            
            $verifiedAccounts[] = [
                'id' => $token->id,
                'account' => $token->account,
                'account_platform' => $token->account_platform,
                'seller_id' => $token->seller_id,
                'user_id' => $token->user_id,
                'country' => $token->country,
                'expires_in' => $token->expires_in,
                'expires_at' => $expiresAt->format('Y-m-d H:i:s'),
                'is_expired' => $isExpired,
                'days_until_expiry' => $isExpired ? 0 : $now->diffInDays($expiresAt, false)
            ];
        }
        
        return [
            'has_verified_accounts' => count($verifiedAccounts) > 0,
            'total_accounts' => count($verifiedAccounts),
            'accounts' => $verifiedAccounts
        ];
    }
}