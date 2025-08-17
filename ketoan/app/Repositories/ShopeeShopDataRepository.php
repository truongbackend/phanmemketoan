<?php

namespace App\Repositories;

use App\Models\ShopData\ShopeeShopTokens;
use Carbon\Carbon;

class ShopeeShopDataRepository
{
    public function findByShopId($shopId)
    {
        return ShopeeShopTokens::where('shop_id', $shopId)->first();
    }

    public function findByAuthUserId($authUserId)
    {
        return ShopeeShopTokens::where('auth_user_id', $authUserId)->first();
    }

    public function findByAuthUserIdAndShopId($authUserId, $shopId)
    {
        return ShopeeShopTokens::where('auth_user_id', $authUserId)->where('shop_id', $shopId)->where('active', 'Y')->first();
    }
    
    public function findByAuthUserIdAndTokenId($authUserId, $tokenId)
    {
        return ShopeeShopTokens::where('auth_user_id', $authUserId)->where('id', $tokenId)->where('active', 'Y')->first();
    }

    public function deactivateToken($authUserId, $tokenId)
    {
        $token = $this->findByAuthUserIdAndTokenId($authUserId, $tokenId);
        if (!$token) {
            throw new \Exception('Token not found for user ID: ' . $authUserId . ' and token ID: ' . $tokenId);
        }
        
        $token->update(['active' => 'N']);
        return $token;
    }

    public function createOrUpdateByShopId($data)
    {
        return ShopeeShopTokens::updateOrCreate(
            [
                'auth_user_id' => $data['auth_user_id'],
                'shop_id' => $data['shop_id'],
            ],
            $data
        );
    }

    public function checkAuthShopStatus($authUserId)
    {
        $tokens = ShopeeShopTokens::where('auth_user_id', $authUserId)->where('active', 'Y')->get();
        
        $verifiedAccounts = [];
        
        foreach ($tokens as $token) {
            $createdAt = Carbon::parse($token->updated_at);
            $expiresAt = $createdAt->addSeconds($token->expire_in);
            $now = Carbon::now();
            
            $isExpired = $now->gt($expiresAt);
            
            $verifiedAccounts[] = [
                'id' => $token->id,
                'shop_id' => $token->shop_id,
                'expire_in' => $token->expire_in,
                'expire_at' => $expiresAt->format('Y-m-d H:i:s'),
                'is_expired' => $isExpired,
                'days_until_expiry' => $isExpired ? 0 : $now->diffInDays($expiresAt, false),
            ];
        }
        
        return [
            'has_verified_accounts' => count($verifiedAccounts) > 0,
            'total_accounts' => count($verifiedAccounts),
            'accounts' => $verifiedAccounts
        ];
    }
}