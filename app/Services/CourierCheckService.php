<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CourierCheckService
{
    protected $apiUrl;
    protected $apiKey;
    protected $enabled;

    public function __construct()
    {
        $this->apiUrl = config('services.bd_courier.url');
        $this->apiKey = config('services.bd_courier.api_key');
        $this->enabled = config('services.bd_courier.enabled', true);
    }

    public function checkCourier($phone)
    {
        if (!$this->enabled) {
            return ['status' => 'disabled', 'message' => 'Service disabled'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl, [
                'phone' => $phone
            ]);

            $result = $response->json();

            Log::info('BD Courier Response', [
                'phone' => $phone,
                'response' => $result
            ]);

            return $result;

        } catch (\Exception $e) {
            Log::error('BD Courier Error', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);

            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
