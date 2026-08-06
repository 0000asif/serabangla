@extends('admin.masterAdmin')

@section('content')
    <div class="container-fluid">


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Order Reports</h3>
            </div>

        </div>

        @include('components.alert')

        {{-- FILTERS --}}

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Filter Reports</h5>
            </div>

            <div class="card-body">
                <form method="GET">
                    <div class="row">


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>From Date</label>
                                <input type="date" class="form-control" name="from_date"
                                    value="{{ request('from_date') }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>To Date</label>
                                <input type="date" class="form-control" name="to_date" value="{{ request('to_date') }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control select2_demo">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>
                                        Processing
                                    </option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Agents</label>
                                <select name="user_id" class="form-control select2_demo">
                                    <option value="">All Users</option>

                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i> Filter
                                    </button>

                                    <a href="{{ url()->current() }}" class="btn btn-secondary">
                                        <i class="fa fa-refresh"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>


            </div>

        </div>

        {{-- KPI CARDS --}}

        <div class="row">

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-primary text-white border-0 shadow">
                    <div class="card-body">
                        <h6>Total Orders</h6>
                        <h2>{{ $totalOrders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-warning border-0 shadow">
                    <div class="card-body">
                        <h6>Pending</h6>
                        <h2>{{ $pendingOrders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-info text-white border-0 shadow">
                    <div class="card-body">
                        <h6>Processing</h6>
                        <h2>{{ $processingOrders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-success text-white border-0 shadow">
                    <div class="card-body">
                        <h6>Completed</h6>
                        <h2>{{ $completedOrders }}</h2>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-4 mb-3">
                <div class="card bg-danger text-white border-0 shadow">
                    <div class="card-body">
                        <h6>Cancelled</h6>
                        <h2>{{ $cancelledOrders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="card bg-dark text-white border-0 shadow">
                    <div class="card-body">
                        <h6>Total Sales</h6>
                        <h2>৳ {{ number_format($totalSales, 2) }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="card bg-secondary text-white border-0 shadow">
                    <div class="card-body">
                        <h6>Filtered Results</h6>
                        <h2>{{ $orders->total() }}</h2>
                    </div>
                </div>
            </div>

        </div>

        {{-- ORDERS TABLE --}}

        <div class="card border-0 shadow">

            <div class="card-header bg-white">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        Order Report List
                    </h5>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover table-bordered align-middle">

                        <thead class="table-light">

                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Manager</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($orders as $key => $order)
                                <tr>

                                    <td>
                                        {{ $orders->firstItem() + $key }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $order->order_id }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $order->user->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $order->customer_name }}
                                    </td>

                                    <td>
                                        {{ $order->customer_phone }}
                                    </td>

                                    <td>
                                        <strong>
                                            ৳ {{ number_format($order->total, 2) }}
                                        </strong>
                                    </td>

                                    <td>

                                        @if ($order->status == 'pending')
                                            <span class="badge bg-warning">
                                                Pending
                                            </span>
                                        @elseif($order->status == 'processing')
                                            <span class="badge bg-info">
                                                Processing
                                            </span>
                                        @elseif($order->status == 'completed')
                                            <span class="badge bg-success">
                                                Completed
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Cancelled
                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ $order->created_at->format('d M Y h:i A') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8" class="text-center">

                                        No Data Found

                                    </td>

                                </tr>
                            @endforelse
                            <tr class="font-weight-bold bg-light">
                                <td colspan="5" class="text-right">
                                    Total Amount
                                </td>
                                <td>
                                    <strong>
                                        ৳ {{ number_format($orders->sum('total'), 2) }}
                                    </strong>
                                </td>
                                <td colspan="2"></td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="card-footer bg-white">

                {{ $orders->withQueryString()->links() }}

            </div>

        </div>


    </div>
@endsection
