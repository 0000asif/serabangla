@extends('admin.masterAdmin')
@section('content')

<div class="card">
    <div class="card-header">
        <h5>Order Details - {{ $order->order_id }}</h5>
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary btn-sm float-end">Back</a>
    </div>
    <div class="card-body">
        <h6>Customer Info</h6>
        <p>Name: {{ $order->customer_name }}</p>
        <p>Phone: {{ $order->customer_phone }}</p>
        <p>Email: {{ $order->customer_email }}</p>
        <p>Address: {{ $order->customer_address }}</p>
        <p>Payment Method: {{ strtoupper($order->payment_method) }}</p>
        <p>Transaction/Account: {{ $order->transaction_id ?? $order->account_number ?? 'N/A' }}</p>

        <hr>
        <h6>Order Items</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>৳ {{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>৳ {{ $item->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr>
        <p>Subtotal: ৳ {{ $order->subtotal }}</p>
        <p>Discount: ৳ {{ $order->discount }}</p>
        <p>Delivery: ৳ {{ $order->delivery }}</p>
        <h5>Total: ৳ {{ $order->total }}</h5>
    </div>
</div>

@endsection
