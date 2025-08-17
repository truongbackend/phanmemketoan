<?php

namespace App\Services;

use App\Repositories\ShopeeShopDataRepository;
use Illuminate\Support\Facades\Http;

class ShopeeAuthService
{
    protected $host;
    protected $partnerId;
    protected $partnerKey;

    public function __construct()
    {
        $this->host = config('services.shopee.host', 'https://partner.test-stable.shopeemobile.com');
        $this->partnerId = config('services.shopee.partner_id');
        $this->partnerKey = config('services.shopee.partner_key');
    }

    public function authShop()
    {
        $path = "/api/v2/shop/auth_partner";
        $redirectUrl = "https://pnl-international.info.vn"; 

        $timest = time();

        $baseString = sprintf("%s%s%s", $this->partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);

        $url = sprintf(
            "%s%s?partner_id=%s&timestamp=%s&sign=%s&redirect=%s", 
            $this->host, $path, $this->partnerId, $timest, $sign, $redirectUrl
        );

        return $url;
    }

    // Lấy token cấp Shop Level
    public function getTokenShopLevel($code, $shopId, $authUserId)
    {
        $path = "/api/v2/auth/token/get";
        $timest = time();
        $body = [
            "code" => $code,
            "shop_id" => intval($shopId),
            "partner_id" => intval($this->partnerId),
        ];
        $baseString = sprintf("%s%s%s", $this->partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $this->partnerId, $timest, $sign);
 
        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post($url, $body);

        $result = $response->json();
        
        if (isset($result['access_token'])) {
            $saveData = [
                'auth_user_id' => $authUserId,
                'shop_id' => $shopId,
                'access_token' => $result['access_token'],
                'refresh_token' => $result['refresh_token'] ?? null,
                'expire_in' => $result['expire_in'],
                'request_id' => $result['request_id'],
                'active' => 'Y',
            ];

            $shopeeShopDataRepository = new ShopeeShopDataRepository();
            $shopeeShopDataRepository->createOrUpdateByShopId($saveData);
        }
        return $result;
    }

    // Lấy token cấp Account Level
    public function getTokenAccountLevel($code, $mainAccountId)
    {
        $path = "/api/v2/auth/token/get";
        $timest = time();
        $body = [
            "code" => $code,
            "main_account_id" => $mainAccountId,
            "partner_id" => $this->partnerId,
        ];
        $baseString = sprintf("%s%s%s", $this->partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $this->partnerId, $timest, $sign);

        $response = Http::withHeaders(['Content-Type' => 'application/jmason'])
            ->post($url, $body);

        $result = $response->json();
        return $result;
    }

    // // Lấy Access Token cấp Shop Level
    // public function getAccessTokenShopLevel($partnerId, $partnerKey, $shopId, $refreshToken)
    // {
    //     $path = "/api/v2/auth/access_token/get";
    //     $timest = time();
    //     $body = [
    //         "partner_id" => intval($partnerId),
    //         "shop_id" => intval($shopId),
    //         "refresh_token" => $refreshToken,
    //     ];
    //     $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
    //     $sign = hash_hmac('sha256', $baseString, $partnerKey);
    //     $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $partnerId, $timest, $sign);

    //     // Gửi yêu cầu POST và nhận phản hồi
    //     $response = Http::withHeaders(['Content-Type' => 'application/json'])
    //         ->post($url, $body);

    //     $result = $response->json();
    //     return $result;
    // }

    // // Lấy Access Token cấp Merchant Level
    // public function getAccessTokenMerchantLevel($partnerId, $partnerKey, $merchantId, $refreshToken)
    // {
    //     $path = "/api/v2/auth/access_token/get";
    //     $timest = time();
    //     $body = [
    //         "partner_id" => $partnerId,
    //         "merchant_id" => $merchantId,
    //         "refresh_token" => $refreshToken,
    //     ];
    //     $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
    //     $sign = hash_hmac('sha256', $baseString, $partnerKey);
    //     $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $partnerId, $timest, $sign);

    //     // Gửi yêu cầu POST và nhận phản hồi
    //     $response = Http::withHeaders(['Content-Type' => 'application/json'])
    //         ->post($url, $body);

    //     $result = $response->json();
    //     return $result;
    // }

    public function checkAuthShopStatus($authUserId)
    {
        $shopeeShopDataRepository = new ShopeeShopDataRepository();
        return $shopeeShopDataRepository->checkAuthShopStatus($authUserId);
    }
}
