<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    
//    public function store(Request $request)
// {
//     $request->validate([
//         'customer_name' => 'required|string|max:255',
//         'customer_phone' => 'required|string|max:20',
//         'customer_address' => 'required|string',
//         'payment_method' => 'required|string',
//         'account_number' => 'required_if:payment_method,bkash,nagad,rocket',
//         'transaction_id' => 'required_if:payment_method,bkash,nagad,rocket',
//     ]);

//     $cart = session('cart', []);

//     if(empty($cart)){
//         return response()->json([
//             'success' => false,
//             'message' => 'Your cart is empty'
//         ]);
//     }

//     $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
//     $discount = $subtotal > 2000 ? $subtotal * 0.1 : 0;
//     $delivery = 110;
//     $total = $subtotal - $discount + $delivery;

//     $order = Order::create([
//         'customer_name' => $request->customer_name,
//         'customer_phone' => $request->customer_phone,
//         'customer_email' => $request->customer_email,
//         'customer_address' => $request->customer_address,
//         'payment_method' => $request->payment_method,
//         'account_number' => $request->account_number,
//         'transaction_id' => $request->transaction_id,
//         'order_note' => $request->order_note,
//         'subtotal' => $subtotal,
//         'discount' => $discount,
//         'delivery' => $delivery,
//         'total' => $total,
//         'order_date' => now(),
//     ]);

//     foreach($cart as $item){
//         OrderItem::create([
//             'order_id' => $order->id,
//             'product_id' => $item['id'],
//             'quantity' => $item['quantity'],
//             'price' => $item['price'],
//         ]);
//     }

//     session()->forget('cart');

//   return back()->with('success', 'আপনার অর্ডার গ্রহণ করা হয়েছে! আমাদের প্রতিনিধি শিগগিরই যোগাযোগ করবে।');
 
// }

      public function store(Request $request)
    {
        // 1️⃣ Validate the form input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'customer_address' => 'required|string',
            'payment_method' => 'required|string',
            'cart' => 'required|min:1',
            'subtotal' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'delivery' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        // dd($request->all());
        // Validate payment fields if necessary
        if (in_array($request->payment_method, ['bkash', 'nagad', 'rocket'])) {
            $request->validate([
                'account_number' => 'required|string',
                'transaction_id' => 'required|string',
            ]);
        }

        // 2️⃣ Create the main order
        $order = Order::create([
            'order_id' => 'LOOM-' . now()->timestamp,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_address' => $request->customer_address,
            'payment_method' => $request->payment_method,
            'account_number' => $request->account_number,
            'transaction_id' => $request->transaction_id,
            'order_note' => $request->order_note,
            'subtotal' => $request->subtotal,
            'discount' => $request->discount ?? 0,
            'delivery' => $request->delivery,
            'total' => $request->total,
            'order_date' => now(),
        ]);

        // 3️⃣ Create order items
        foreach ($request->cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'] ?? 'Unknown',
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

    // 4️⃣ Clear the cart
    session()->forget('cart');

        // 4️⃣ Redirect back with success message
        return redirect()->back()->with('success', 'আপনার অর্ডার গ্রহণ করা হয়েছে! আমাদের প্রতিনিধি শিগগিরই যোগাযোগ করবে।');
    }


    public function index() {
    $orders = Order::latest()->get();
    return view('admin.orders.index', compact('orders'));
}

public function show($id) {
    $order = Order::with('items')->findOrFail($id);
    return view('admin.orders.show', compact('order'));
}

public function updateStatus(Request $request, $id) {
    $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled'
    ]);

    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return redirect()->back()->with('success', 'Order status updated successfully.');
}
}