<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

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

    public function readLogsByDate(Request $request)
    {
        try {
            $date = $request->input('date');
            
            if (!$date) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Date parameter is required (format: Y-m-d)'
                ], 422);
            }

            // Validate date format
            try {
                $carbonDate = Carbon::parse($date);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid date format. Use Y-m-d format (e.g., 2025-01-06)'
                ], 422);
            }

            $logPath = storage_path('logs/api_callback/api_callback-' . $carbonDate->format('Y-m-d') . '.log');
            
            if (!File::exists($logPath)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Log file not found for date: ' . $date,
                    'file_path' => $logPath
                ], 404);
            }

            // Đọc toàn bộ file log
            $logContent = File::get($logPath);
            
            // Parse log content thành array
            $logEntries = $this->parseLogContent($logContent);
            
            return response()->json([
                'status' => 'success',
                'date' => $date,
                'file_path' => $logPath,
                'total_entries' => count($logEntries),
                'data' => $logEntries
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error reading log file: ' . $e->getMessage()
            ], 500);
        }
    }

    private function parseLogContent($content)
    {
        $entries = [];
        $lines = explode("\n", $content);
        
        $currentEntry = [];
        $entryStarted = false;
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            if (empty($line)) {
                continue;
            }
            
            // Kiểm tra xem có phải là dòng bắt đầu log entry không
            if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.+)$/', $line, $matches)) {
                // Nếu đã có entry trước đó, lưu nó
                if ($entryStarted && !empty($currentEntry)) {
                    $entries[] = $this->formatLogEntry($currentEntry);
                }
                
                // Bắt đầu entry mới
                $currentEntry = [
                    'timestamp' => $matches[1],
                    'level' => $matches[2],
                    'channel' => $matches[3],
                    'message' => $matches[4],
                    'raw_content' => $line
                ];
                $entryStarted = true;
            } else {
                // Thêm vào content của entry hiện tại
                if ($entryStarted) {
                    $currentEntry['raw_content'] .= "\n" . $line;
                    
                    // Thử parse JSON content
                    if (strpos($line, '{') !== false && strpos($line, '}') !== false) {
                        $jsonStart = strpos($line, '{');
                        $jsonEnd = strrpos($line, '}') + 1;
                        $jsonContent = substr($line, $jsonStart, $jsonEnd - $jsonStart);
                        
                        $decoded = json_decode($jsonContent, true);
                        if ($decoded !== null) {
                            $currentEntry['parsed_data'] = $decoded;
                        }
                    }
                }
            }
        }
        
        // Thêm entry cuối cùng
        if ($entryStarted && !empty($currentEntry)) {
            $entries[] = $this->formatLogEntry($currentEntry);
        }
        
        return $entries;
    }

    private function formatLogEntry($entry)
    {
        $formatted = [
            'timestamp' => $entry['timestamp'],
            'level' => $entry['level'],
            'channel' => $entry['channel'],
            'message' => $entry['message'],
            'raw_content' => $entry['raw_content']
        ];
        
        if (isset($entry['parsed_data'])) {
            $formatted['parsed_data'] = $entry['parsed_data'];
        }
        
        return $formatted;
    }
} 