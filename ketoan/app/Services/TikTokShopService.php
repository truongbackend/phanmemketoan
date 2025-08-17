<?php

namespace App\Services;

use App\Repositories\TiktokshopShopDataRepository;
use Illuminate\Support\Facades\Http;

class TikTokShopService
{
    protected $repo;
    public function __construct(TiktokshopShopDataRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAuthorisationLink()
    {
        return config('services.tiktokshop.authorisation_link') . '?service_id=' . config('services.tiktokshop.authorisation_service_id');
    }

    public function getAuthToken($authCode, $authUserId)
    {
        $appKey = config('services.tiktokshop.app_key');
        $appSecret = config('services.tiktokshop.app_secret');
        $apiUrl = config('services.tiktokshop.tiktok_api_url');
        $grantType = 'authorized_code';

        $url = $apiUrl . '/v2/token/get';
        
        $params = [
            'app_key' => $appKey,
            'app_secret' => $appSecret,
            'auth_code' => $authCode,
            'grant_type' => $grantType
        ];

        try {
            $response = Http::get($url, $params);
            
            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => $response->json(),
                    'status_code' => $response->status()
                ];
            }

            $dataResponse = $response->json();

            if(strtolower($dataResponse['message']) !== 'success') {
                return [
                    'success' => false,
                    'error' => $dataResponse['message'],
                    'status_code' => $response->status()
                ];
            }

            if(!isset($dataResponse['data'])) {
                return [
                    'success' => false,
                    'error' => 'Invalid response',
                    'status_code' => $response->status()
                ];
            }
            
            $dataResponse = $dataResponse['data'];

            $data = [
                    'auth_user_id' => $authUserId,
                    'open_id' => $dataResponse['open_id'],
                    'access_token' => $dataResponse['access_token'],
                    'refresh_token' => $dataResponse['refresh_token'],
                    'access_token_expire_in' => $dataResponse['access_token_expire_in'],
                    'refresh_token_expire_in' => $dataResponse['refresh_token_expire_in'],
                    'seller_name' => $dataResponse['seller_name'],
                    'seller_base_region' => $dataResponse['seller_base_region'],
                    'granted_scopes' => json_encode($dataResponse['granted_scopes']),
                    'user_type' => $dataResponse['user_type'],
                    'active' => 'Y',
                ];
            $this->repo->createOrUpdateByShopId($data);

            return [
                'success' => $response->successful(),
                'status_code' => $response->status()
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'status_code' => 500
            ];
        }
    }
}