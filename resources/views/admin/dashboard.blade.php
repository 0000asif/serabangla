@extends('admin.masterAdmin')

@section('content')
    <style>
        .dashboard-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }

        .dashboard-card .card-body {
            padding: 25px;
        }

        .dashboard-card h2 {
            font-weight: 700;
            margin: 0;
        }

        .stats-card {
            border: none;
            border-left: 5px solid;
            border-radius: 10px;
        }

        .table th {
            white-space: nowrap;
        }

        .badge {
            padding: 8px 12px;
            font-size: 12px;
        }

        .filter-card {
            border: none;
            border-radius: 12px;
        }

        .bg-soft-warning {
            background-color: #fff3cd;
        }

        .bg-soft-info {
            background-color: #d1ecf1;
        }

        .bg-soft-primary {
            background-color: #cce5ff;
        }

        .bg-soft-success {
            background-color: #d4edda;
        }

        .bg-soft-danger {
            background-color: #f8d7da;
        }

        .text-warning-dark {
            color: #856404;
        }

        .text-info-dark {
            color: #0c5460;
        }

        .text-primary-dark {
            color: #004085;
        }

        .text-success-dark {
            color: #155724;
        }

        .text-danger-dark {
            color: #721c24;
        }
    </style>

    <div class="page-heading mb-4">
        <div class="page-breadcrumb">
            <h1 class="page-title">Dashboard</h1>
        </div>
    </div>

    @include('components.alert')

    {{-- REPORT HEADER --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h3 class="mb-1">Order Reports</h3>
        </div>
    </div>

    {{-- TOP KPI --}}
    <div class="row mb-4">
        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card dashboard-card bg-primary text-white shadow">
                <div class="card-body">
                    <small>Today's Orders</small>
                    <h2>{{ $todayOrders ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card dashboard-card bg-success text-white shadow">
                <div class="card-body">
                    <small>Total Orders</small>
                    <h2>{{ $totalOrders ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card dashboard-card bg-warning shadow">
                <div class="card-body">
                    <small>Pending</small>
                    <h2>{{ $pendingOrders ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card dashboard-card bg-info shadow">
                <div class="card-body">
                    <small>Shipped</small>
                    <h2>{{ $shippedOrders ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card dashboard-card bg-success text-white shadow">
                <div class="card-body">
                    <small>Return</small>
                    <h2>{{ $deliveredOrders ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card dashboard-card bg-dark text-white shadow">
                <div class="card-body">
                    <small>Total Sales</small>
                    <h2>৳ {{ number_format($totalSales ?? 0, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card filter-card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fa fa-filter"></i>
                Filter Reports
            </h5>
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label>From Date</label>
                        <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>To Date</label>
                        <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Return</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="hold" {{ request('status') == 'hold' ? 'selected' : '' }}>Hold
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Agent</label>
                        <select name="user_id" class="form-control">
                            <option value="">All Agents</option>
                            @if(isset($users) && $users->count() > 0)
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-3 mb-3 d-flex align-items-end">
                        <button class="btn btn-primary me-2">
                            <i class="fa fa-search"></i>
                            Filter
                        </button>
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- STATUS REPORT --}}
    <div class="row mb-4">
        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card stats-card shadow-sm bg-soft-warning" style="border-left-color:#ffc107">
                <div class="card-body">
                    <small class="text-warning-dark">Hold</small>
                    <h3 class="text-warning-dark">{{ $holdOrders ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card stats-card shadow-sm bg-soft-info" style="border-left-color:#0dcaf0">
                <div class="card-body">
                    <small class="text-info-dark">Processing</small>
                    <h3 class="text-info-dark">{{ $processingOrders ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card stats-card shadow-sm bg-soft-primary" style="border-left-color:#007bff">
                <div class="card-body">
                    <small class="text-primary-dark">Shipped</small>
                    <h3 class="text-primary-dark">{{ $shippedOrders ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card stats-card shadow-sm bg-soft-success" style="border-left-color:#28a745">
                <div class="card-body">
                    <small class="text-success-dark">Return</small>
                    <h3 class="text-success-dark">{{ $deliveredOrders ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card stats-card shadow-sm bg-soft-success" style="border-left-color:#198754">
                <div class="card-body">
                    <small class="text-success-dark">Completed</small>
                    <h3 class="text-success-dark">{{ $completedOrders ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 mb-3">
            <div class="card stats-card shadow-sm bg-soft-danger" style="border-left-color:#dc3545">
                <div class="card-body">
                    <small class="text-danger-dark">Cancelled</small>
                    <h3 class="text-danger-dark">{{ $cancelledOrders ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0">Order Report List</h5>
                <a href="{{ route('admin.orders.export', request()->query()) }}" class="btn btn-success">
                    <i class="fa fa-download"></i>
                    Export CSV
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Agent</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders ?? [] as $key => $order)
                            <tr>
                                <td>{{ $orders->firstItem() + $key }}</td>
                                <td><strong>{{ $order->order_id }}</strong></td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td><strong>৳ {{ number_format($order->total, 2) }}</strong></td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-warning',
                                            'processing' => 'bg-info',
                                            'shipped' => 'bg-primary',
                                            'delivered' => 'bg-success',
                                            'completed' => 'bg-success',
                                            'cancelled' => 'bg-danger'
                                        ];

                                        $statusColor = $statusColors[$order->status] ?? 'bg-secondary';

                                        $statusText = $order->status === 'delivered'
                                            ? 'Return'
                                            : ucfirst($order->status);
                                    @endphp

                                    <span class="badge {{ $statusColor }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    <i class="fa fa-inbox"></i> No orders found
                                </td>
                            </tr>
                        @endforelse

                        {{-- Total Row --}}
                        @if(isset($orders) && $orders->count() > 0)
                            <tr class="table-success">
                                <td colspan="5" class="text-end"><strong>Total Amount</strong></td>
                                <td><strong class="text-success">৳ {{ number_format($totalSales ?? 0, 2) }}</strong></td>
                                <td colspan="2"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $orders->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

@endsection