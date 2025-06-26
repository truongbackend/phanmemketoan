<?php

namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopeeAuthService;

class AuthShopeeController extends Controller
{
    public function getAuthShopUrl(Request $request)
    {
        $partnerId = $request->input('partner_id');
        $partnerKey = $request->input('partner_key');
        if (!$partnerId || !$partnerKey) {
            return response()->json([
                'status' => false,
                'message' => 'Missing partner_id or partner_key'
            ], 400);
        }
        $shopeeAuthService = new ShopeeAuthService();
        $url = $shopeeAuthService->authShop($partnerId, $partnerKey);
        return response()->json([
            'status' => true,
            'auth_url' => $url
        ]);
    }

    public function getTokenShopLevel(Request $request)
    {
        $partnerId = $request->input('partner_id');
        $partnerKey = $request->input('partner_key');
        $code = $request->input('code');
        $shopId = $request->input('shop_id');
        if (!$partnerId || !$partnerKey || !$code || !$shopId) {
            return response()->json([
                'status' => false,
                'message' => 'Missing partner_id, partner_key, code hoặc shop_id'
            ], 400);
        }
        $service = new \App\Services\ShopeeAuthService();
        $result = $service->getTokenShopLevel($partnerId, $partnerKey, $code, $shopId);
        return response()->json($result);
    }

    public function getTokenAccountLevel(Request $request)
    {
        $partnerId = $request->input('partner_id');
        $partnerKey = $request->input('partner_key');
        $code = $request->input('code');
        $mainAccountId = $request->input('main_account_id');
        if (!$partnerId || !$partnerKey || !$code || !$mainAccountId) {
            return response()->json([
                'status' => false,
                'message' => 'Missing partner_id, partner_key, code hoặc main_account_id'
            ], 400);
        }
        $service = new \App\Services\ShopeeAuthService();
        $result = $service->getTokenAccountLevel($partnerId, $partnerKey, $code, $mainAccountId);
        return response()->json($result);
    }

    public function getAccessTokenShopLevel(Request $request)
    {
        $partnerId = $request->input('partner_id');
        $partnerKey = $request->input('partner_key');
        $shopId = $request->input('shop_id');
        $refreshToken = $request->input('refresh_token');
        if (!$partnerId || !$partnerKey || !$shopId || !$refreshToken) {
            return response()->json([
                'status' => false,
                'message' => 'Missing partner_id, partner_key, shop_id hoặc refresh_token'
            ], 400);
        }
        $service = new \App\Services\ShopeeAuthService();
        $result = $service->getAccessTokenShopLevel($partnerId, $partnerKey, $shopId, $refreshToken);
        return response()->json($result);
    }

    public function getAccessTokenMerchantLevel(Request $request)
    {
        $partnerId = $request->input('partner_id');
        $partnerKey = $request->input('partner_key');
        $merchantId = $request->input('merchant_id');
        $refreshToken = $request->input('refresh_token');
        if (!$partnerId || !$partnerKey || !$merchantId || !$refreshToken) {
            return response()->json([
                'status' => false,
                'message' => 'Missing partner_id, partner_key, merchant_id hoặc refresh_token'
            ], 400);
        }
        $service = new \App\Services\ShopeeAuthService();
        $result = $service->getAccessTokenMerchantLevel($partnerId, $partnerKey, $merchantId, $refreshToken);
        return response()->json($result);
    }
}
