<?php

namespace App\Http\Controllers\Shopee;

use App\Http\Controllers\Controller;
use App\Repositories\ShopeeShopDataRepository;
use Illuminate\Http\Request;
use App\Services\ShopeeAuthService;

class ShopeeController extends Controller
{
    public function getAuthShopUrl(Request $request)
    {
        $shopeeAuthService = new ShopeeAuthService();
        $url = $shopeeAuthService->authShop();
        
        return response()->json([
            'status' => true,
            'auth_url' => $url
        ]);
    }

    public function getTokenShopLevel(Request $request)
    {
        $code = $request->input('code');
        $shopId = $request->input('shop_id');
        if (!$code || !$shopId) {
            return response()->json([
                'status' => false,
                'message' => 'Missing code or shop_id'
            ], 400);
        }
        $user = auth()->user();
        $authUserId = $user->id;
        $service = new ShopeeAuthService();
        $result = $service->getTokenShopLevel($code, $shopId, $authUserId);

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function deactivateToken(Request $request)
    {
        try {
            $user = auth()->user();
            $userId = $user->id;
            $tokenId = $request->input('token_id');

            if (!$tokenId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token ID is required'
                ], 422);
            }

            $shopeeShopDataRepository = new ShopeeShopDataRepository();
            $token = $shopeeShopDataRepository->deactivateToken($userId, $tokenId);

            return response()->json([
                'status' => true,
                'message' => 'Token đã được deactivate thành công',
                'data' => [
                    'id' => $token->id,
                    'shop_id' => $token->shop_id,
                    'active' => $token->active
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getTokenAccountLevel(Request $request)
    {
        $code = $request->input('code');
        $mainAccountId = $request->input('main_account_id');
        if (!$code || !$mainAccountId) {
            return response()->json([
                'status' => false,
                'message' => 'Missing code or main_account_id'
            ], 400);
        }
        $service = new ShopeeAuthService();
        $result = $service->getTokenAccountLevel($code, $mainAccountId);
        return response()->json($result);
    }

    // public function getAccessTokenShopLevel(Request $request)
    // {
    //     $shopId = $request->input('shop_id');
    //     $refreshToken = $request->input('refresh_token');
    //     if (!$shopId || !$refreshToken) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Missing shop_id or refresh_token'
    //         ], 400);
    //     }
    //     $service = new ShopeeAuthService();
    //     $result = $service->getAccessTokenShopLevel($shopId, $refreshToken);
    //     return response()->json($result);
    // }

    // public function getAccessTokenMerchantLevel(Request $request)
    // {
    //     $merchantId = $request->input('merchant_id');
    //     $refreshToken = $request->input('refresh_token');
    //     if (!$merchantId || !$refreshToken) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Missing merchant_id or refresh_token'
    //         ], 400);
    //     }
    //     $service = new ShopeeAuthService();
    //     $result = $service->getAccessTokenMerchantLevel($merchantId, $refreshToken);
    //     return response()->json($result);
    // }

    public function checkAuthShopStatus(Request $request)
    {
        try {
            $authUserId = auth()->user()->id;
            $shopeeAuthService = new ShopeeAuthService();
            $result = $shopeeAuthService->checkAuthShopStatus($authUserId);
        
            return response()->json([
            'status' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
