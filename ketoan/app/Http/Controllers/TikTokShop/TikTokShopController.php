<?php

namespace App\Http\Controllers\TikTokShop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TikTokShopService;

class TikTokShopController extends Controller
{
    protected $tiktokShopService;

    public function __construct(TikTokShopService $tiktokShopService)
    {
        $this->tiktokShopService = $tiktokShopService;
    }

    public function getAuthShopUrl(Request $request)
    {
        $authorisation_link = $this->tiktokShopService->getAuthorisationLink();

        return response()->json([
            'status' => true,
            'data' => $authorisation_link
        ]);
    }

    public function getAuthToken(Request $request)
    {
        try {
            $request->validate([
                'auth_code' => 'required|string'
            ]);
    
            $authCode = $request->input('auth_code');
            $authUserId = auth()->user()->id;
            
            $result = $this->tiktokShopService->getAuthToken($authCode, $authUserId);
    
            if ($result['success']) {
                return response()->json([
                    'status' => true,
                    'message' => 'Successfully authenticated with TikTok Shop'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => $result['error'] ?? 'Error occurred while getting auth token'
                ], $result['status_code'] ?? 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
