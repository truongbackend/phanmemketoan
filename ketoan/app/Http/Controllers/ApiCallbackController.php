<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiCallbackController extends Controller
{
    public function handleCallback(Request $request)
    {
        try {
            $requestData = [
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'headers' => $request->headers->all(),
                'query_params' => $request->query(),
                'body_params' => $request->all(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now()->toISOString(),
            ];

            Log::channel('api_callback')->info('API Callback Request', $requestData);

            return response()->json([
                'status' => 'success',
                'message' => 'Request received and logged successfully',
                'timestamp' => now()->toISOString(),
                'request_id' => uniqid('req_', true)
            ], 200);

        } catch (\Exception $e) {
            Log::channel('api_callback')->error('API Callback Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'timestamp' => now()->toISOString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Internal server error',
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }
} 