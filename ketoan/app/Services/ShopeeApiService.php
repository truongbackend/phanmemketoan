<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShopeeApiService
{
    protected $partnerId;
    protected $shopId;
    protected $apiKey;
    protected $apiSecret;
    protected $accessToken;

    public function __construct()
    {
        $this->partnerId = env('SHOPEE_PARTNER_ID');
        $this->shopId = env('SHOPEE_SHOP_ID');
        $this->apiKey = env('SHOPEE_API_KEY');
        $this->apiSecret = env('SHOPEE_API_SECRET');
        $this->accessToken = env('SHOPEE_ACCESS_TOKEN');
    }

    public function getProducts()
    {
        $url = "https://partner.shopeemobile.com/api/v1/products/get";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->get($url, [
            'partner_id' => $this->partnerId,
            'shop_id' => $this->shopId,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'Không thể lấy sản phẩm từ Shopee'];
    }
}
