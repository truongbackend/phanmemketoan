<?php

namespace App\Http\Controllers\Lazada;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LazadaApiService;
use App\Services\ShopDataService;

class LazopController extends Controller
{
    protected $lazadaApiService;
    protected $shopDataService;
    public function __construct(LazadaApiService $lazadaApiService, ShopDataService $shopDataService)
    {
        $this->lazadaApiService = $lazadaApiService;
        $this->shopDataService = $shopDataService;
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
            $user = auth()->user();
            $userId = $user->id;
            $code = $request->input('code');
            $data = $this->lazadaApiService->getAccessToken($code, $userId);
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

    public function pushReceipt(Request $request)
    {
        try {
            $createdBefore = $request->input('created_before');
            $createdAfter = $request->input('created_after');

            // Validate required
            if (!$createdBefore || !$createdAfter) {
                return response()->json([
                    'status' => false,
                    'message' => 'created_before và created_after là bắt buộc.'
                ], 422);
            }

            // Convert format dd/mm/yyyy HH:ii:ss => Y-m-d\TH:i:sP
            $from = \DateTime::createFromFormat('d/m/Y H:i:s', $createdAfter);
            $to = \DateTime::createFromFormat('d/m/Y H:i:s', $createdBefore);
            if (!$from || !$to) {
                return response()->json([
                    'status' => false,
                    'message' => 'Định dạng ngày tháng không hợp lệ. Định dạng đúng: dd/mm/yyyy HH:ii:ss'
                ], 422);
            }
            $tz = '+07:00';
            $createdAfterIso = $from->format('Y-m-d\TH:i:s') . $tz;
            $createdBeforeIso = $to->format('Y-m-d\TH:i:s') . $tz;

            // Validate logic
            if ($to <= $from) {
                return response()->json([
                    'status' => false,
                    'message' => 'created_before phải lớn hơn created_after.'
                ], 422);
            }
            $interval = $from->diff($to)->days;
            if ($interval > 30) {
                return response()->json([
                    'status' => false,
                    'message' => 'Khoảng thời gian không được lớn hơn 30 ngày.'
                ], 422);
            }

            $params = [
                'created_before' => $createdBeforeIso,
                'created_after' => $createdAfterIso,
                'sort_by' => 'updated_at',
                'sort_direction' => 'DESC',
                //'status' => $request->input('status'),
            ];

            $accessToken = $this->shopDataService->getTokenByAuthUserId(auth()->user()->id);
            
            $data = $this->lazadaApiService->getOrderList($accessToken, $params);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
