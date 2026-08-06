<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\CourierCheckService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckCourierJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(CourierCheckService $courierCheck)
    {
        try {
            $result = $courierCheck->checkCourier($this->order->customer_phone);

            if (isset($result['status']) && $result['status'] === 'success') {
                $summary = $result['data']['summary'] ?? null;

                $this->order->courier_data = json_encode($result['data']);
                $this->order->courier_total_parcel = $summary['total_parcel'] ?? 0;
                $this->order->courier_success_ratio = $summary['success_ratio'] ?? 0;
                $this->order->is_fraud_risk = ($summary['success_ratio'] ?? 100) < 50;
                $this->order->save();
            }

            Log::info('Courier Check Job Completed', [
                'order_id' => $this->order->order_id,
                'is_fraud_risk' => $this->order->is_fraud_risk ?? false
            ]);
        } catch (\Exception $e) {
            Log::error('Courier Check Job Failed', [
                'order_id' => $this->order->order_id,
                'error' => $e->getMessage()
            ]);
        }
    }
}
