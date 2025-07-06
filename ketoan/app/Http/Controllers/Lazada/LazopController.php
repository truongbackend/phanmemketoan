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

    private function responseApiLzd($data)
    {
        if (isset($data['code']) && $data['code'] != '0') {
            return response()->json([
                'status' => false,
                'code' => $data['code'],
                'message' => $data['message'] ?? 'Unknown error'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
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

            // Convert format dd/mm/yyyy => Y-m-d\TH:i:sP
            $from = \DateTime::createFromFormat('d/m/Y', $createdAfter);
            $to = \DateTime::createFromFormat('d/m/Y', $createdBefore);

            if (!$from || !$to) {
                return response()->json([
                    'status' => false,
                    'message' => 'Định dạng ngày tháng không hợp lệ. Định dạng đúng: dd/mm/yyyy'
                ], 422);
            }

            $from->modify('-3 days');
            $from->setTime(0, 0, 0);
            $to->setTime(23, 59, 59);

            $tz = '+07:00';
            $createdAfterIso = $from->format('Y-m-d\TH:i:s') . $tz;
            $createdBeforeIso = $to->format('Y-m-d\TH:i:s') . $tz;
            
            // Validate logic
            if ($to <= $from) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ngày bắt đầu phải lớn hơn ngày kết thúc.'
                ], 422);
            }

            $interval = $from->diff($to)->days;
            if ($interval > 30) {
                return response()->json([
                    'status' => false,
                    'message' => 'Khoảng thời gian không được lớn hơn 30 ngày.'
                ], 422);
            }

            // Prepare params
            $params = [
                'created_before' => $createdBeforeIso,
                'created_after' => $createdAfterIso,
                'sort_by' => 'updated_at',
                'sort_direction' => 'DESC',
                'offset' => $request->input('offset', 0),
                'limit' => $request->input('limit', 100),
                'status' => 'delivered',
            ];

            $accessToken = $this->shopDataService->getTokenByAuthUserId(auth()->user()->id);
            
            $data = $this->lazadaApiService->getOrderList($accessToken, $params);
            
            if ($data['code'] != '0') {
                return $this->responseApiLzd($data);
            }

            $data = $data['data'] ?? [];
            $totalRecord = $data['countTotal'] ?? 0;
            $totalInPage = $data['count'] ?? 0;
            $listOrder = $data['orders'] ?? [];
            $listOrderOrderNumbers = ($totalInPage > 0) ? array_column($listOrder, 'order_number') : [];
            $dataOrderItems = [];

            if (!empty($listOrderOrderNumbers)) {
                $dataOrderItems = $this->lazadaApiService->getOrderItemsByListID($accessToken, $listOrderOrderNumbers);
                
                if ($dataOrderItems['code'] != '0') {
                    return $this->responseApiLzd($dataOrderItems);
                }
            }
            
            return response()->json([
                'status' => true,
                'data' => $data,
                'data_items' => $dataOrderItems,
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'code' => '0',
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
