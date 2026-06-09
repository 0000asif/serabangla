@extends('admin.masterAdmin')
@section('content')
@php
use App\Models\Order;
use App\Models\Product;
$totalProducts = Product::count();
$totalOrders = Order::count();
$pendingOrders = Order::where('status', 'pending')->count();
@endphp
<!-- BEGIN: Page heading-->
<div class="page-heading">
    <div class="page-breadcrumb">
        <h1 class="page-title">Dashboard</h1>
    </div>
</div>
<!-- END: Page heading-->

<!-- BEGIN: Dashboard cards-->
<div class="row g-4">

    <!-- Total Products Card -->
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Products</h5>
                        <h2 class="card-text">{{ $totalProducts }}</h2>
                    </div>
                    <div>
                        <i class="ti-package fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Orders Card -->
    <div class="col-md-4">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Orders</h5>
                        <h2 class="card-text">{{ $totalOrders }}</h2>
                    </div>
                    <div>
                        <i class="ti-shopping-cart fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Orders Card -->
    <div class="col-md-4">
        <div class="card text-white bg-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Pending Orders</h5>
                        <h2 class="card-text">{{ $pendingOrders }}</h2>
                    </div>
                    <div>
                        <i class="ti-timer fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END: Dashboard cards-->

@endsection