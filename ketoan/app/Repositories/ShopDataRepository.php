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

    public function findByAuthUserIdAndShopId($authUserId, $shopId)
    {
        return LazadaShopTokens::where('auth_user_id', $authUserId)->where('shop_id', $shopId)->where('active', 'Y')->first();
    }

    public function findByAuthUserIdAndId($authUserId, $id)
    {
        return LazadaShopTokens::where('auth_user_id', $authUserId)
                               ->where('id', $id)
                               ->first();
    }

    public function deactivateToken($authUserId, $id)
    {
        $token = $this->findByAuthUserIdAndId($authUserId, $id);
        if (!$token) {
            throw new \Exception('Token not found for user ID: ' . $authUserId . ' and token ID: ' . $id);
        }
        
        $token->update(['active' => 'N']);
        return $token;
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
        $tokens = LazadaShopTokens::where('auth_user_id', $authUserId)->where('active', 'Y')->get();
        
        $verifiedAccounts = [];
        
        foreach ($tokens as $token) {
            $createdAt = Carbon::parse($token->updated_at);
            $expiresAt = $createdAt->addSeconds($token->expires_in);
            $refreshExpiresAt = $createdAt->addSeconds($token->refresh_expires_in);
            $now = Carbon::now();
            
            $isExpired = $now->gt($expiresAt);
            $isRefreshExpired = $now->gt($refreshExpiresAt);
            
            $verifiedAccounts[] = [
                'id' => $token->id,
                'account' => $token->account,
                'account_platform' => $token->account_platform,
                'seller_id' => $token->seller_id,
                'user_id' => $token->user_id,
                'country' => $token->country,
                'short_code' => $token->short_code,
                'expires_in' => $token->expires_in,
                'expires_at' => $expiresAt->format('Y-m-d H:i:s'),
                'is_expired' => $isExpired,
                'days_until_expiry' => $isExpired ? 0 : $now->diffInDays($expiresAt, false),
                'refresh_expires_in' => $token->refresh_expires_in,
                'refresh_expires_at' => $refreshExpiresAt->format('Y-m-d H:i:s'),
                'is_refresh_expired' => $isRefreshExpired,
                'days_until_refresh_expiry' => $isRefreshExpired ? 0 : $now->diffInDays($refreshExpiresAt, false)
            ];
        }
        
        return [
            'has_verified_accounts' => count($verifiedAccounts) > 0,
            'total_accounts' => count($verifiedAccounts),
            'accounts' => $verifiedAccounts
        ];
    }
}