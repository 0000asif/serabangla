<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use App\Jobs\SendSalesConfirmationJob;
use App\Jobs\CheckCourierJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Imports\GiftImport;
use App\Models\Gift;
use App\Services\SalesConfirmationService;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\IpBlockingService;
use App\Models\BlockedIp;
use App\Models\Customer;


class OrderController extends Controller
{

    public function store(Request $request)
    {

        $phone = $request->customer_phone;
        if (Customer::isBlocked($phone)) {
            Log::warning('Blocked user attempted to order', ['phone' => $phone]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'আপনার অ্যাকাউন্ট ব্লক করা হয়েছে। অনুগ্রহ করে সহায়তা নিন।'
                ], 403);
            }

            return redirect()->back()->with('error', 'আপনার অ্যাকাউন্ট ব্লক করা হয়েছে।');
        }
        // dd($request->all()); // Remove this in production

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric',
            'product' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        // Begin transaction to ensure data consistency
        \DB::beginTransaction();

        try {
            $customer = Customer::where('phone', $request->customer_phone)->first();

            if ($customer) {
                // পুরনো কাস্টমার - order_count বাড়ান
                $customer->order_count = $customer->order_count + 1;
                $customer->name = $request->customer_name;
                $customer->address = $request->customer_address;
                $customer->save();
            } else {
                // নতুন কাস্টমার - তৈরি করুন
                $customer = Customer::create([
                    'name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'order_count' => 1,
                    'blocked' => 0
                ]);
            }
            // Generate unique order ID
            $orderId = 'SB-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            // Prepare order data
            $orderData = [
                'order_id' => $orderId,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'order_note' => $request->order_note,
                'subtotal' => $request->subtotal,
                'total' => $request->total,
                'product' => $request->product,
                'quantity' => $request->quantity,
                'delivery' => $request->delivery_charge,
                'product_id' => $request->product_id,
                'status' => 'pending',
                'is_reddem' => false, // Default value
                'customer_id' => $customer->id, // ← Customer ID


            ];

            // Handle gift code if applied
            // if ($request->filled('gift_id') && $request->filled('discount')) {
            //     $gift = Gift::find($request->gift_id);

            //     if ($gift) {
            //         // Check if gift is already redeemed
            //         $existingRedeem = Order::where('customer_phone', $request->customer_phone)
            //             ->where('gift_id', $gift->id)
            //             ->where('is_reddem', 1)
            //             ->first();

            //         if (!$existingRedeem) {
            //             $orderData['discount'] = $request->discount;

            //             // Update gift usage count 1if you have that field
            //             // $gift->increment('used_count');
            //         } else {
            //             // Gift already used, don't apply discount
            //             \DB::rollBack();
            //             return response()->json([
            //                 'success' => false,
            //                 'message' => 'This gift code has already been used'
            //             ], 400);
            //         }
            //     }

            //     $oldorder =  Order::where('customer_phone', $request->customer_phone)
            //         ->where('gift_id', $gift->id)
            //         ->where('is_reddem', 0)
            //         ->first();
            //     $oldorder->is_reddem = 1;
            //     $oldorder->save();
            // }

            // Create order
            $order = Order::create($orderData);

            // Commit transaction
            \DB::commit();



            SendSalesConfirmationJob::dispatch($order)
                ->delay(now()->addSeconds(20));

            CheckCourierJob::dispatch($order)
                ->delay(now()->addSeconds(5));

            // ✅ Check if AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'অর্ডার সফল হয়েছে!',
                    'order_id' => $order->order_id,
                    'order' => $order
                ]);
            }

            // For regular form submission (fallback)
            return redirect()->back()->with('success', 'আপনার অর্ডার গ্রহণ করা হয়েছে! আমাদের প্রতিনিধি শিগগিরই যোগাযোগ করে আপনার অর্ডার কনফার্ম করবে।');
        } catch (\Exception $e) {
            \DB::rollBack();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order creation failed: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Order creation failed. Please try again.');
        }
    }

    /**
     * অর্ডার থেকে কাস্টমার ব্লক করুন
     */
    public function blockFromOrder(Request $request, $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            $phone = $order->customer_phone;

            // কাস্টমার খুঁজুন বা তৈরি করুন
            $customer = Customer::firstOrCreate(
                ['phone' => $phone],
                [
                    'name' => $order->customer_name,
                    'address' => $order->customer_address
                ]
            );

            // ইতিমধ্যে ব্লক আছে কিনা চেক করুন
            if ($customer->blocked == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'এই ইউজার ইতিমধ্যে ব্লক করা আছে।'
                ], 400);
            }

            // ব্লক করুন
            $customer->blocked = 1;
            $customer->save();

            // অর্ডার আপডেট করুন (ঐচ্ছিক)
            $order->is_user_blocked = 1;
            $order->save();

            // লগ করুন
            Log::info('Customer blocked from order', [
                'order_id' => $order->order_id,
                'phone' => $phone,
                'customer_id' => $customer->id,
                'blocked_by' => auth()->user()->name ?? 'admin'
            ]);

            return response()->json([
                'success' => true,
                'message' => "{$customer->name} ({$phone}) ব্লক করা হয়েছে।",
                'customer' => $customer
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to block customer from order', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'ব্যর্থ হয়েছে: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * কাস্টমার আনব্লক করুন
     */
    public function unblock($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->blocked = 0;
            $customer->save();

            // এই কাস্টমারের সব অর্ডার আপডেট করুন
            Order::where('customer_phone', $customer->phone)
                ->update(['is_user_blocked' => 0]);

            Log::info('Customer unblocked', [
                'customer_id' => $customer->id,
                'phone' => $customer->phone,
                'unblocked_by' => auth()->user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', "{$customer->name} আনব্লক করা হয়েছে।");

        } catch (\Exception $e) {
            Log::error('Failed to unblock customer', [
                'customer_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'আনব্লক করতে ব্যর্থ হয়েছে।');
        }
    }

    /**
     * কাস্টমার ব্লক/আনব্লক টগল করুন
     */
    public function toggleBlock($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->blocked = $customer->blocked == 1 ? 0 : 1;
            $customer->save();

            // অর্ডার আপডেট করুন
            Order::where('customer_phone', $customer->phone)
                ->update(['is_user_blocked' => $customer->blocked]);

            $status = $customer->blocked == 1 ? 'ব্লক' : 'আনব্লক';

            Log::info("Customer {$status}ed", [
                'customer_id' => $customer->id,
                'phone' => $customer->phone,
                'action_by' => auth()->user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', "{$customer->name} {$status} করা হয়েছে।");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'টগল করতে ব্যর্থ হয়েছে।');
        }
    }
    public function recallOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'phone' => 'required|string',
            'product' => 'required|string'
        ]);

        try {
            $order = Order::findOrFail($request->order_id);

            // Check if order is already confirmed
            if ($order->confirmation_status === 'confirmed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Order already confirmed',
                    'status' => $order->confirmation_status
                ]);
            }

            Log::info('🔔 Recall Order Initiated', [
                'order_id' => $order->order_id,
                'phone' => $request->phone,
                'product' => $request->product,
                'old_status' => $order->confirmation_status
            ]);

            // ============================================
            // Direct API Call
            // ============================================
            $salesConfirmation = new SalesConfirmationService();
            $result = $salesConfirmation->sendConfirmation(
                $request->phone,
                $request->product,
                $order->order_id
            );

            // 🔍 DEBUG: Log the raw result
            Log::info('📊 Raw API Result', [
                'order_id' => $order->order_id,
                'result' => $result
            ]);

            // ============================================
            // ডেটা আপডেট - প্রতিটি ফিল্ড চেক করে
            // ============================================

            // 1. Basic fields
            $order->confirmation_status = $result['confirmation_status'] ?? 'pending';
            $order->confirmation_called_at = now();

            // 2. Call details
            $order->confirmation_record_id = $result['record_id'] ?? null;
            $order->confirmation_call_status = $result['call_status'] ?? null;
            $order->confirmation_call_duration = isset($result['call_duration']) ? (int) $result['call_duration'] : 0;
            $order->confirmation_dtmf_input = isset($result['dtmf_input']) ? (string) $result['dtmf_input'] : '';

            // 3. Customer response
            $order->customer_pressed_1 = isset($result['customer_pressed_1']) ? (bool) $result['customer_pressed_1'] : false;
            $order->customer_pressed_2 = isset($result['customer_pressed_2']) ? (bool) $result['customer_pressed_2'] : false;
            $order->transferred_to_agent = isset($result['transferred_to_agent']) ? (bool) $result['transferred_to_agent'] : false;

            // 4. Trunk info
            $order->confirmation_trunk_used = $result['trunk_used'] ?? null;
            $order->confirmation_trunk_display = $result['trunk_display'] ?? null;

            // 5. Product info
            $order->confirmation_product_name = $result['product_name'] ?? null;
            $order->confirmation_product_value = $result['product_value'] ?? null;

            // 6. Full response (JSON)
            $order->confirmation_data = json_encode($result);
            $order->confirmation_full_response = json_encode($result);

            // 7. Message
            $order->confirmation_message = $result['message'] ?? null;

            // 8. Recall tracking
            $order->confirmation_recall_count = ($order->confirmation_recall_count ?? 0) + 1;
            $order->confirmation_last_recall_at = now();

            // 🔍 DEBUG: Log before save
            Log::info('📝 Attempting to save order', [
                'order_id' => $order->order_id,
                'confirmation_status' => $order->confirmation_status,
                'call_status' => $order->confirmation_call_status,
                'dtmf_input' => $order->confirmation_dtmf_input,
                'call_duration' => $order->confirmation_call_duration,
                'recall_count' => $order->confirmation_recall_count
            ]);

            // ✅ SAVE THE ORDER
            $saved = $order->save();

            // 🔍 DEBUG: Check if saved
            Log::info('💾 Save Result', [
                'order_id' => $order->order_id,
                'saved' => $saved,
                'confirmation_status' => $order->confirmation_status
            ]);

            // 🔍 DEBUG: Verify by fetching fresh data
            $freshOrder = Order::find($order->id);
            Log::info('🔍 Fresh Order Data After Save', [
                'order_id' => $freshOrder->order_id,
                'confirmation_status' => $freshOrder->confirmation_status,
                'confirmation_called_at' => $freshOrder->confirmation_called_at,
                'confirmation_dtmf_input' => $freshOrder->confirmation_dtmf_input,
                'confirmation_recall_count' => $freshOrder->confirmation_recall_count
            ]);

            // ✅ Return success response
            return response()->json([
                'success' => true,
                'message' => 'Recall call initiated and data saved successfully!',
                'data' => [
                    'order_id' => $order->order_id,
                    'confirmation_status' => $order->confirmation_status,
                    'call_status' => $order->confirmation_call_status,
                    'dtmf_input' => $order->confirmation_dtmf_input,
                    'call_duration' => $order->confirmation_call_duration,
                    'recall_count' => $order->confirmation_recall_count,
                    'saved' => $saved
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Recall Order Failed', [
                'order_id' => $request->order_id ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Update order with error
            if (isset($order)) {
                try {
                    $order->confirmation_status = 'failed';
                    $order->confirmation_message = 'Recall Error: ' . $e->getMessage();
                    $order->confirmation_last_recall_at = now();
                    $order->confirmation_recall_count = ($order->confirmation_recall_count ?? 0) + 1;
                    $order->save();

                    Log::info('💾 Error saved to order', [
                        'order_id' => $order->order_id,
                        'error_message' => $e->getMessage()
                    ]);
                } catch (\Exception $saveError) {
                    Log::error('Failed to save error status', [
                        'order_id' => $order->order_id ?? 'unknown',
                        'error' => $saveError->getMessage()
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Recall failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('gift')->findOrFail($id);
        $gifts = Gift::all();
        return view('admin.orders.show', compact('order', 'gifts'));
    }

    /**
     * Update order status - AJAX Support
     * Allowed statuses: pending, processing, shipped, delivered, completed, cancelled
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled,hold'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;

        // Update user_id if authenticated
        if (auth()->check()) {
            $order->user_id = auth()->user()->id;
        }

        $order->save();

        // Check if AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully.',
                'status' => $order->status,
                'status_label' => ucfirst($order->status)
            ]);
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    /**
     * Update order status from details page (Form submission)
     */
    public function updateStatusForm(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;

        if (auth()->check()) {
            $order->user_id = auth()->user()->id;
        }

        $order->save();

        return redirect()->route('admin.order.show', $id)->with('success', 'Order status updated successfully.');
    }

    /**
     * Delete a single order
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id, &$orderId) {
                $order = Order::findOrFail($id);

                $orderId = $order->order_id;

                $customer = Customer::where('phone', $order->customer_phone)->first();

                if ($customer) {
                    $customer->decrement('order_count');
                }

                $order->delete();
            });

            // Log the deletion for audit purposes
            Log::info('Order deleted', [
                'order_id' => $orderId,
                'deleted_by' => auth()->user()->id ?? null,
                'deleted_at' => now()
            ]);

            return redirect()->route('admin.orders')->with('success', 'Order #' . $orderId . ' has been deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Order deletion failed', [
                'order_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('admin.orders')->with('error', 'Failed to delete order. Please try again.');
        }
    }

    /**
     * Bulk delete orders (optional)
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id'
        ]);

        try {
            $orderIds = $request->order_ids;
            $orders = Order::whereIn('id', $orderIds)->get();
            $orderIdsList = $orders->pluck('order_id')->implode(', ');

            // Optional: Check if any order cannot be deleted
            // $deletableStatuses = ['pending', 'cancelled'];
            // $nonDeletable = $orders->filter(function($order) use ($deletableStatuses) {
            //     return !in_array($order->status, $deletableStatuses);
            // });
            // if ($nonDeletable->count() > 0) {
            //     return redirect()->back()->with('error', 'Some orders cannot be deleted due to their status.');
            // }

            DB::beginTransaction();

            // Delete order items if any
            // OrderItem::whereIn('order_id', $orderIds)->delete();

            // Delete orders
            Order::whereIn('id', $orderIds)->delete();

            DB::commit();

            Log::info('Bulk orders deleted', [
                'order_ids' => $orderIds,
                'deleted_by' => auth()->user()->id ?? null,
                'deleted_at' => now()
            ]);

            return redirect()->route('admin.orders')->with('success', $orders->count() . ' orders have been deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk order deletion failed', [
                'order_ids' => $request->order_ids ?? [],
                'error' => $e->getMessage()
            ]);

            return redirect()->route('admin.orders')->with('error', 'Failed to delete orders. Please try again.');
        }
    }

    public function dashboard(Request $request)
    {
        $query = Order::query()->with('user');

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Clone query for statistics
        $statsQuery = clone $query;

        $totalOrders = $statsQuery->count();

        $pendingOrders = (clone $query)
            ->where('status', 'pending')
            ->count();
        $holdOrders = (clone $query)
            ->where('status', 'hold')
            ->count();

        $processingOrders = (clone $query)
            ->where('status', 'processing')
            ->count();

        $shippedOrders = (clone $query)
            ->where('status', 'shipped')
            ->count();

        $deliveredOrders = (clone $query)
            ->where('status', 'delivered')
            ->count();

        $completedOrders = (clone $query)
            ->where('status', 'completed')
            ->count();

        $cancelledOrders = (clone $query)
            ->where('status', 'cancelled')
            ->count();

        $totalSales = (clone $query)
            ->whereIn('status', ['delivered', 'completed'])
            ->sum('total');

        $todayOrders = Order::whereDate('created_at', today())
            ->count();

        $orders = $query
            ->latest()
            ->paginate(20);

        $users = User::orderBy('name')->get();

        return view('admin.dashboard', compact(
            'orders',
            'users',
            'todayOrders',
            'totalOrders',
            'pendingOrders',
            'holdOrders',
            'processingOrders',
            'shippedOrders',
            'deliveredOrders',
            'completedOrders',
            'cancelledOrders',
            'totalSales'
        ));
    }
    public function importView()
    {
        return view('admin.orders.import');
    }
    public function giftview()
    {
        $gifts = Gift::get();
        return view('admin.orders.giftview', compact('gifts'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        Excel::import(new GiftImport, $request->file('file'));

        return back()->with('success', 'Gifts imported successfully.');
    }

    public function validateGift(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'phone' => 'required|string',
        ]);

        $gift = Gift::where('name', $request->code)->first();

        if (!$gift) {
            return response()->json([
                'valid' => false
            ]);
        }

        $order = Order::where('customer_phone', $request->phone)
            ->where('gift_id', $gift->id)
            ->first();

        if (!$order) {
            return response()->json([
                'valid' => false
            ]);
        }

        if ($order->is_reddem) {
            return response()->json([
                'valid' => false
            ]);
        }

        preg_match('/(\d+)/', $gift->value, $matches);

        return response()->json([
            'valid' => true,
            'gift_id' => $gift->id,
            'discount' => (int) ($matches[1] ?? 0),
        ]);
    }

    public function export(Request $request)
    {
        $filename = 'orders_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $callback = function () use ($request) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Headers
            fputcsv($file, [
                'Order ID',
                'Product',
                'Agent',
                'Customer',
                'Phone',
                'Address',
                'Subtotal',
                'Total',
                'Status',
                'Order Date'
            ]);

            $query = Order::with('user');

            if ($request->filled('from_date')) {
                $query->whereDate('created_at', '>=', $request->from_date);
            }

            if ($request->filled('to_date')) {
                $query->whereDate('created_at', '<=', $request->to_date);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            foreach ($query->get() as $order) {
                fputcsv($file, [
                    $order->order_id,
                    $order->product,
                    $order->user->name ?? 'N/A',
                    $order->customer_name,
                    $order->customer_phone,
                    $order->customer_address,
                    $order->subtotal,
                    $order->total,
                    $order->status,
                    $order->created_at->format('d M Y h:i A')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function updateFullOrder(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'order_note' => 'nullable|string',
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled',
            'product_qty' => 'required|integer|min:1',
            'product_display' => 'required|string',
            'product_price' => 'required|numeric|min:0', // subtotal
            'delivery_charge' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'gift_id' => 'nullable|exists:gifts,id',
            'courier_id' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::findOrFail($id);



            // ---- Calculate totals ----
            $subtotal = $request->product_price; // already quantity * unit_price
            $delivery = $request->delivery_charge ?? 0;
            $discount = $request->discount ?? 0;
            $total = $subtotal + $delivery - $discount;

            // Ensure total is not negative
            if ($total < 0) {
                throw new \Exception('Total cannot be negative. Check discount and delivery.');
            }

            // ---- Update all fields ----
            $order->customer_name = $request->customer_name;
            $order->customer_phone = $request->customer_phone;
            $order->customer_address = $request->customer_address;
            $order->order_note = $request->order_note;
            $order->status = $request->status;
            $order->quantity = $request->product_qty;
            $order->product = $request->product_display;
            $order->subtotal = $subtotal;
            $order->discount = $discount;
            $order->delivery = $delivery;
            $order->total = $total;
            $order->courier_id = $request->courier_id;
            $order->gift_id = $request->gift_id;

            // If gift was newly assigned and is valid, we already set is_reddem=1, but we also need to store discount? 
            // The discount is already stored in the discount field; no need to duplicate.

            $order->save();

            // ---- Update gift usage count (optional) ----
            // If you have a 'used_count' field on gifts, you may increment/decrement accordingly.
            // For simplicity, we rely on is_reddem flag.

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'order' => $order
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order: ' . $e->getMessage()
            ], 500);
        }
    }
    public function updateFullOrderold(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);

            // Update customer info
            $order->customer_name = $request->customer_name;
            $order->customer_phone = $request->customer_phone;
            $order->customer_address = $request->customer_address;
            $order->order_note = $request->order_note;
            $order->status = $request->status;
            $order->quantity = $request->product_qty;
            $order->gift_id = $request->gift_id;
            $order->courier_id = $request->courier_id;

            // Update product
            $order->product = $request->product_display;
            $order->subtotal = $request->product_price;
            $order->total = $request->product_price + ($request->delivery_charge ?? 0);

            $order->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'order' => $order
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order: ' . $e->getMessage()
            ], 500);
        }
    }
}