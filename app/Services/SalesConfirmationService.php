<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SalesConfirmationService
{
    protected $apiUrl;
    protected $apiKey;
    protected $enabled;
    protected $recordsUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.sales_confirmation.url');
        $this->apiKey = config('services.sales_confirmation.api_key');
        $this->enabled = config('services.sales_confirmation.enabled', true);
        $this->recordsUrl = 'http://43.231.78.150:5004/records'; // CDR API
    }

    public function sendConfirmation($phone, $product, $orderId)
    {
        if (!$this->enabled) {
            return $this->errorResponse('Service disabled');
        }

        if (preg_match('/^015/', $phone)) {
            return $this->errorResponse('Teletalk numbers not supported');
        }

        try {
            $phone = (string) $phone;
            $product = (string) $product;
            $orderId = (string) $orderId;

            Log::info('📞 API Request', [
                'orderId' => $orderId,
                'phone' => $phone,
                'product' => $product
            ]);

            // ✅ ১ম API Call - কল initiate করুন
            $response = Http::timeout(120)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post($this->apiUrl, [
                    'phone' => $phone,
                    'product' => $product,
                ]);

            Log::info('📥 API Response', [
                'orderId' => $orderId,
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            $result = $response->json();

            if (empty($result)) {
                return $this->errorResponse('Empty response from API');
            }

            // ✅ যদি record_id পাওয়া যায়, তাহলে CDR থেকে ডাটা নিন
            if (!empty($result['record_id'])) {
                $recordId = $result['record_id'];
                
                Log::info('⏳ Fetching CDR for record_id: ' . $recordId);
                
                // ✅ ৬০ সেকেন্ড পর্যন্ত Polling করুন (Press 2 এর জন্য)
                $maxAttempts = 6;
                $sleepTime = 10;
                $cdrData = null;
                
                for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
                    Log::info("🔄 CDR Polling attempt {$attempt}/{$maxAttempts}");
                    
                    // CDR থেকে ডাটা নিন
                    $cdrResponse = Http::timeout(10)
                        ->get($this->recordsUrl);
                    
                    if ($cdrResponse->successful()) {
                        $cdrData = $cdrResponse->json();
                        
                        if (!empty($cdrData['records'])) {
                            // এই record_id খুঁজুন
                            foreach ($cdrData['records'] as $record) {
                                if ($record['id'] == $recordId) {
                                    Log::info('✅ Found record in CDR', [
                                        'record_id' => $recordId,
                                        'status' => $record['call_status'],
                                        'duration' => $record['call_duration'],
                                        'dtmf' => $record['dtmf_input']
                                    ]);
                                    
                                    // ✅ CDR ডাটা দিয়ে Result ওভাররাইট করুন
                                    $result['call_status'] = $record['call_status'] ?? $result['call_status'];
                                    $result['call_duration'] = (int) ($record['call_duration'] ?? 0);
                                    $result['dtmf_input'] = (string) ($record['dtmf_input'] ?? '');
                                    $result['customer_pressed_1'] = (bool) ($record['customer_pressed_1'] ?? false);
                                    $result['customer_pressed_2'] = (bool) ($record['customer_pressed_2'] ?? false);
                                    $result['transferred_to_agent'] = (bool) ($record['transferred_to_agent'] ?? false);
                                    
                                    // ✅ যদি transferred বা completed হয়, তাহলে break
                                    if (in_array($result['call_status'], ['transferred', 'completed', 'no_answer'])) {
                                        Log::info('✅ Got final status from CDR: ' . $result['call_status']);
                                        break 2; // Both loops break
                                    }
                                    break;
                                }
                            }
                        }
                    }
                    
                    // ১০ সেকেন্ড অপেক্ষা
                    sleep($sleepTime);
                }
            }

            return $this->processResult($result, $phone, $product);

        } catch (\Exception $e) {
            Log::error('❌ API Error', [
                'orderId' => $orderId,
                'error' => $e->getMessage()
            ]);
            return $this->errorResponse('API Error: ' . $e->getMessage());
        }
    }

    // ✅ Result Processing
    private function processResult($result, $phone, $product)
    {
        $callStatus = $result['call_status'] ?? 'unknown';
        $dtmf = $result['dtmf_input'] ?? '';
        $duration = (int) ($result['call_duration'] ?? 0);
        $pressed1 = (bool) ($result['customer_pressed_1'] ?? false);
        $pressed2 = (bool) ($result['customer_pressed_2'] ?? false);
        $transferred = (bool) ($result['transferred_to_agent'] ?? false);

        // ✅ Status Determine
        if ($dtmf === '1' || $pressed1) {
            $status = 'confirmed';
        } elseif ($dtmf === '2' || $pressed2 || $transferred) {
            $status = 'transferred';
        } elseif ($callStatus === 'completed') {
            $status = 'completed';
        } elseif ($callStatus === 'transferred') {
            $status = 'transferred';
        } elseif ($callStatus === 'no_answer') {
            $status = 'no_answer';
        } elseif ($callStatus === 'timeout') {
            $status = 'timeout';
        } elseif ($callStatus === 'busy') {
            $status = 'busy';
        } else {
            $status = 'pending';
        }

        Log::info('✅ Processed Result', [
            'phone' => $phone,
            'call_status' => $callStatus,
            'duration' => $duration,
            'dtmf' => $dtmf,
            'final_status' => $status
        ]);

        return [
            'success' => $result['success'] ?? false,
            'record_id' => $result['record_id'] ?? null,
            'phone' => $result['phone'] ?? $phone,
            'product_value' => $result['product_value'] ?? $product,
            'product_name' => $result['product_name'] ?? '',
            'call_status' => $callStatus,
            'call_duration' => $duration,
            'dtmf_input' => $dtmf,
            'customer_pressed_1' => $pressed1,
            'customer_pressed_2' => $pressed2,
            'transferred_to_agent' => $transferred,
            'message' => $result['message'] ?? 'No message',
            'trunk_used' => $result['trunk_used'] ?? null,
            'trunk_display' => $result['trunk_display'] ?? null,
            'confirmation_status' => $status,
        ];
    }

    private function errorResponse($message)
    {
        return [
            'success' => false,
            'confirmation_status' => 'failed',
            'message' => $message,
            'call_status' => 'error',
            'record_id' => null,
            'call_duration' => 0,
            'dtmf_input' => '',
            'customer_pressed_1' => false,
            'customer_pressed_2' => false,
            'transferred_to_agent' => false,
            'trunk_used' => null,
            'trunk_display' => null
        ];
    }
}
