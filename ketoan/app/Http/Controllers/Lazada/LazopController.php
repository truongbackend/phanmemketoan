<?php

namespace App\Http\Controllers\Lazada;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LazadaApiService;

class LazopController extends Controller
{
    protected $lazadaApiService;
    public function __construct(LazadaApiService $lazadaApiService)
    {
        $this->lazadaApiService = $lazadaApiService;
    }

    public function getAuthShopUrl(Request $request)
    {
        $appKey = env('LAZOP_APP_KEY');
        $appSecret = env('LAZOP_APP_SECRET');
        $callbackUrl = env('LAZOP_CALLBACK_URL');
        
        if (!$appKey || !$appSecret) {
            return response()->json([
                'status' => false,
                'message' => 'Missing app_key or app_secret'
            ], 400);
        }

        $url = 'https://auth.lazada.com/oauth/authorize?response_type=code'
        . '&force_auth=true'
        . '&country=vn'
        . '&redirect_uri=' . urlencode($callbackUrl)
        . '&client_id=' . $appKey;

        return response()->json([
            'status' => true,
            'auth_url' => $url
        ]);
    }

    public function getShopAccessToken(Request $request)
    {
        try {
            $code = $request->input('code');
            $data = $this->lazadaApiService->getAccessToken($code);
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getShopRefreshtoken(Request $request)
    {
        try {
            $refreshToken = $request->input('refresh_token');
            $data = $this->lazadaApiService->refreshToken($refreshToken);
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getShopOrderList(Request $request)
    {
        try {
            $accessToken = $request->input('access_token');
            $params = $request->only([
                'created_before', 'created_after', 'sort_by', 'sort_direction',
                'status', 'update_before', 'offset', 'limit', 'update_after'
            ]);
            $data = $this->lazadaApiService->getOrderList($accessToken, $params);
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
