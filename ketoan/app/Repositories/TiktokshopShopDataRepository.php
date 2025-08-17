<?php

namespace App\Repositories;

use App\Models\ShopData\TiktokshopShopTokens;
use Carbon\Carbon;

class TiktokshopShopDataRepository
{
    public function findByOpenId($openId)
    {
        return TiktokshopShopTokens::where('open_id', $openId)->first();
    }

    public function findByAuthUserId($authUserId)
    {
        return TiktokshopShopTokens::where('auth_user_id', $authUserId)->first();
    }

    public function findByAuthUserIdAndTokenId($authUserId, $tokenId)
    {
        return TiktokshopShopTokens::where('auth_user_id', $authUserId)->where('id', $tokenId)->where('active', 'Y')->first();
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
        return TiktokshopShopTokens::updateOrCreate(
            [
                'auth_user_id' => $data['auth_user_id'],
                'open_id' => $data['open_id'],
            ],
            $data
        );
    }

    public function checkAuthShopStatus($authUserId)
    {
        $tokens = TiktokshopShopTokens::where('auth_user_id', $authUserId)->where('active', 'Y')->get();
        
        $verifiedAccounts = [];
        
        foreach ($tokens as $token) {
            $createdAt = Carbon::parse($token->updated_at);
            $expiresAt = $createdAt->addSeconds($token->access_token_expire_in);
            $refreshExpiresAt = $createdAt->addSeconds($token->refresh_token_expire_in);
            $now = Carbon::now();
            
            $isExpired = $now->gt($expiresAt);
            $isRefreshExpired = $now->gt($refreshExpiresAt);
            
            $verifiedAccounts[] = [
                'open_id' => $token->open_id,
                'seller_name' => $token->seller_name,
                'seller_base_region' => $token->seller_base_region,
                'expires_in' => $token->access_token_expire_in,
                'expires_at' => $expiresAt->format('Y-m-d H:i:s'),
                'is_expired' => $isExpired,
                'days_until_expiry' => $isExpired ? 0 : $now->diffInDays($expiresAt, false),
                'refresh_expires_in' => $token->refresh_token_expire_in,
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