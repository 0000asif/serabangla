<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\SalesConfirmationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSalesConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $tries = 1;  // ← ১ বার চেষ্টা করুন (Retry বন্ধ)
    public $timeout = 180;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(SalesConfirmationService $salesConfirmation)
    {
        try {
            $this->order->refresh();

            // ইতিমধ্যে হয়ে গেলে Skip
            if (in_array($this->order->confirmation_status, ['confirmed', 'transferred', 'completed'])) {
                Log::info('⏭️ Already processed', [
                    'order_id' => $this->order->order_id,
                    'status' => $this->order->confirmation_status
                ]);
                return;
            }

            Log::info('📞 Job Started', [
                'order_id' => $this->order->order_id,
                'attempt' => $this->attempts()
            ]);

            // API Call
            $result = $salesConfirmation->sendConfirmation(
                $this->order->customer_phone,
                (string) $this->order->product_id,
                $this->order->order_id
            );

            $newStatus = $result['call_status'] ?? 'pending';

            // Priority System
            $priority = [
                'confirmed' => 10,
                'transferred' => 9,
                'completed' => 8,
                'no_answer' => 5,
                'timeout' => 3,
                'busy' => 2,
                'pending' => 1,
                'error' => 0,
                'failed' => 0
            ];

            $currentStatus = $this->order->confirmation_call_status ?? 'pending';
            $currentPriority = $priority[$currentStatus] ?? 0;
            $newPriority = $priority[$newStatus] ?? 0;

            if ($newPriority > $currentPriority) {
                $this->order->confirmation_status = $result['confirmation_status'] ?? 'pending';
                $this->order->confirmation_called_at = now();
                $this->order->confirmation_record_id = $result['record_id'] ?? null;
                $this->order->confirmation_call_status = $result['call_status'] ?? null;
                $this->order->confirmation_call_duration = (int) ($result['call_duration'] ?? 0);
                $this->order->confirmation_dtmf_input = (string) ($result['dtmf_input'] ?? '');
                $this->order->confirmation_message = $result['message'] ?? null;
                $this->order->customer_pressed_1 = (bool) ($result['customer_pressed_1'] ?? false);
                $this->order->customer_pressed_2 = (bool) ($result['customer_pressed_2'] ?? false);
                $this->order->transferred_to_agent = (bool) ($result['transferred_to_agent'] ?? false);
                $this->order->confirmation_trunk_used = $result['trunk_used'] ?? null;
                $this->order->confirmation_trunk_display = $result['trunk_display'] ?? null;
                $this->order->confirmation_product_name = $result['product_name'] ?? null;
                $this->order->confirmation_product_value = $result['product_value'] ?? null;
                $this->order->confirmation_data = json_encode($result);
                $this->order->confirmation_full_response = json_encode($result);
                $this->order->save();

                Log::info('✅ Order Updated', [
                    'order_id' => $this->order->order_id,
                    'status' => $this->order->confirmation_call_status,
                    'duration' => $this->order->confirmation_call_duration,
                    'dtmf' => $this->order->confirmation_dtmf_input
                ]);
            } else {
                Log::info('⏭️ Skipping lower priority', [
                    'order_id' => $this->order->order_id,
                    'current' => $currentStatus,
                    'new' => $newStatus
                ]);
            }

            // ❌ Retry বাদ দিন! timeout হলেও আর কল হবে না
            // if ($newStatus === 'timeout' && $this->attempts() < $this->tries) {
            //     throw new \Exception('Timeout - retry');
            // }

        } catch (\Exception $e) {
            Log::error('❌ Job Failed', [
                'order_id' => $this->order->order_id ?? 'unknown',
                'attempt' => $this->attempts(),
                'error' => $e->getMessage()
            ]);

            // ❌ Retry করবেন না
            // if ($this->attempts() < $this->tries) {
            //     throw $e;
            // }

            // শেষ চেষ্টা
            if ($this->order) {
                $this->order->refresh();
                if (in_array($this->order->confirmation_status, ['pending', 'timeout', null])) {
                    $this->order->confirmation_status = 'failed';
                    $this->order->confirmation_message = 'Job failed: ' . $e->getMessage();
                    $this->order->save();
                }
            }
        }
    }

    public function failed(\Throwable $exception)
    {
        Log::error('💀 Job Permanently Failed', [
            'order_id' => $this->order->order_id ?? 'unknown',
            'error' => $exception->getMessage()
        ]);
    }
}
