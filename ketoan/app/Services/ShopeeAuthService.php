<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class ShopeeAuthService
{
    protected $host;

    public function __construct()
    {
        $this->host = config('services.shopee.host', 'https://partner.test-stable.shopeemobile.com');
    }

    public function authShop($partnerId, $partnerKey)
    {
        $path = "/api/v2/shop/auth_partner";
        $redirectUrl = "https://pnl-international.info.vn"; 

        $timest = time();

        $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $partnerKey);

        $url = sprintf(
            "%s%s?partner_id=%s&timestamp=%s&sign=%s&redirect=%s", 
            $this->host, $path, $partnerId, $timest, $sign, $redirectUrl
        );

        return $url;
    }

    // Lấy token cấp Shop Level
    public function getTokenShopLevel($partnerId, $partnerKey, $code, $shopId)
    {
        $path = "/api/v2/auth/token/get";
        $timest = time();
        $body = [
            "code" => $code,
            "shop_id" => intval($shopId),
            "partner_id" => intval($partnerId),
        ];
        $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $partnerId, $timest, $sign);
        //dd($url, $body);
        // Gửi yêu cầu POST và nhận phản hồi
        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post($url, $body);

        $result = $response->json();
        return $result;
    }

    // Lấy token cấp Account Level
    public function getTokenAccountLevel($partnerId, $partnerKey, $code, $mainAccountId)
    {
        $path = "/api/v2/auth/token/get";
        $timest = time();
        $body = [
            "code" => $code,
            "main_account_id" => $mainAccountId,
            "partner_id" => $partnerId,
        ];
        $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $partnerId, $timest, $sign);

        $response = Http::withHeaders(['Content-Type' => 'application/jmason'])
            ->post($url, $body);

        $result = $response->json();
        return $result;
    }

    // Lấy Access Token cấp Shop Level
    public function getAccessTokenShopLevel($partnerId, $partnerKey, $shopId, $refreshToken)
    {
        $path = "/api/v2/auth/access_token/get";
        $timest = time();
        $body = [
            "partner_id" => intval($partnerId),
            "shop_id" => intval($shopId),
            "refresh_token" => $refreshToken,
        ];
        $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $partnerId, $timest, $sign);

        // Gửi yêu cầu POST và nhận phản hồi
        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post($url, $body);

        $result = $response->json();
        return $result;
    }

    // Lấy Access Token cấp Merchant Level
    public function getAccessTokenMerchantLevel($partnerId, $partnerKey, $merchantId, $refreshToken)
    {
        $path = "/api/v2/auth/access_token/get";
        $timest = time();
        $body = [
            "partner_id" => $partnerId,
            "merchant_id" => $merchantId,
            "refresh_token" => $refreshToken,
        ];
        $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $partnerId, $timest, $sign);

        // Gửi yêu cầu POST và nhận phản hồi
        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post($url, $body);

        $result = $response->json();
        return $result;
    }
}
