<?php
namespace App\Services;

use App\Services\ShopDataService;
use LazopSdk\lazop\LazopClient;
use LazopSdk\lazop\LazopRequest;

class LazadaApiService
{
    protected $shopDataService;
    protected $appKey;
    protected $appSecret;
    protected $client;
    public function __construct(ShopDataService $shopDataService)
    {
        $this->shopDataService = $shopDataService;
        $this->appKey = env('LAZOP_APP_KEY');
        $this->appSecret = env('LAZOP_APP_SECRET');
        $this->client = new LazopClient('https://api.lazada.com/rest', $this->appKey, $this->appSecret);
    }

    public function getAccessToken($code)
    {
        if (!$this->appKey || !$this->appSecret || !$code) {
            throw new \Exception('Missing app_key, app_secret or code');
        }
        $lazopRequest = new LazopRequest('/auth/token/create');
        $lazopRequest->addApiParam('code', $code);
        $response = $this->client->execute($lazopRequest);
        $data = json_decode($response, true);
        if (isset($data['access_token'])) {
            $dataUserInfo = $data['country_user_info'] ?? [];
            $saveData = [
                'access_token' => $data['access_token'],
                'refresh_token' => $data['refresh_token'] ?? null,
                'account_platform' => 'lazada',
                'account' => $data['account'] ?? null,
                'seller_id' => $dataUserInfo['seller_id'] ?? null,
                'user_id' => $dataUserInfo['user_id'] ?? null,
                'country' => $data['country'] ?? null,
                'short_code' => $dataUserInfo['short_code'] ?? null,
                'expires_in' => $data['expires_in'] ?? null,
                'refresh_expires_in' => $data['refresh_expires_in'] ?? null,
                'code' => $code,
                'request_id' => $data['request_id'] ?? null,
                'trace_id' => $data['_trace_id_'] ?? null,
            ];
            $this->shopDataService->saveOrUpdateLazadaShopToken($saveData);
        }
        return $data;
    }

    public function refreshToken($refreshToken)
    {
        if (!$this->appKey || !$this->appSecret || !$refreshToken) {
            throw new \Exception('Missing app_key, app_secret or refresh_token');
        }
        $lazopRequest = new LazopRequest('/auth/token/refresh');
        $lazopRequest->addApiParam('refresh_token', $refreshToken);
        $response = $this->client->execute($lazopRequest);
        return json_decode($response, true);
    }

    public function getOrderList($accessToken, $params = [])
    {
        if (!$this->appKey || !$this->appSecret || !$accessToken) {
            throw new \Exception('Missing app_key, app_secret or access_token');
        }
        $lazopRequest = new LazopRequest('/orders/get', 'GET');
        foreach ($params as $key => $value) {
            $lazopRequest->addApiParam($key, $value);
        }
        $response = $this->client->execute($lazopRequest, $accessToken);
        return json_decode($response, true);
    }
}
