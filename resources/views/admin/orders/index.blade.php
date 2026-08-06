{{-- resources/views/admin/orders/index.blade.php --}}

@extends('admin.masterAdmin')
@section('content')

<style>
    .status-badge {
        padding: 5px 12px;
        border-radius: 5px;
        font-weight: bold;
        display: inline-block;
        font-size: 12px;
    }
    .status-pending { background: #ffc107; color: #000; }
    .status-hold { background: #f59e0b; color: #000; }
    .status-processing { background: #17a2b8; color: #fff; }
    .status-shipped { background: #007bff; color: #fff; }
    .status-delivered { background: #28a745; color: #fff; }
    .status-completed { background: #28a745; color: #fff; }
    .status-cancelled { background: #dc3545; color: #fff; }
    
    .btn i { margin-right: 5px; }
    
    .fraud-risk { background: #dc3545; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .fraud-safe { background: #28a745; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .fraud-pending { background: #6c757d; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    
    .confirmation-confirmed { background: #28a745; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .confirmation-declined { background: #dc3545; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .confirmation-transferred { background: #17a2b8; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .confirmation-no-answer { background: #ffc107; color: #000; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .confirmation-timeout { background: #f59e0b; color: #000; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .confirmation-busy { background: #6c757d; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .confirmation-pending { background: #ffc107; color: #000; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .confirmation-failed { background: #dc3545; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    .confirmation-unknown { background: #6c757d; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 11px; display: inline-block; }
    
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        align-items: center;
    }
    .action-buttons .btn { white-space: nowrap; }
    .action-buttons form { display: inline-block; }
    
    .status-select {
        width: auto;
        min-width: 120px;
        display: inline-block;
    }
    
    /* 🚫 ব্লক ইউজার বাটনের স্টাইল */
    .btn-block-user {
        background: #dc3545;
        color: #fff;
        padding: 2px 10px;
        font-size: 11px;
        border-radius: 4px;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .btn-block-user:hover {
        background: #c82333;
        transform: scale(1.05);
    }
    .btn-block-user.blocked {
        background: #28a745;
        cursor: default;
    }
    .btn-block-user.blocked:hover {
        background: #28a745;
        transform: none;
    }
    .btn-block-user:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    /* ইউজার ব্লক স্ট্যাটাস ইন্ডিকেটর */
    .user-blocked-badge {
        background: #dc3545;
        color: #fff;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: bold;
        display: inline-block;
        margin-left: 5px;
    }
    
    .courier-summary {
        font-size: 11px;
        line-height: 1.2;
    }
    .overall-summary {
        padding: 5px;
        background: #f8f9fa;
        border-radius: 4px;
        border-left: 3px solid #007bff;
    }
    .courier-item { padding: 1px 0; }
    .courier-item strong { color: #495057; }
</style>

<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="box-title">Order List</h5>
            <div>
                <a href="{{ route('admin.orders.export') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-download"></i> Export CSV
                </a>
                <a href="{{ route('admin.customers') }}" class="btn btn-info btn-sm">
                    <i class="fa fa-users"></i> All Customers
                </a>
            </div>
        </div>

        <div class="card-body">
            @include('components.alert')

            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dt-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th>SL</th>
                            <th>Manage By</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Previous Order</th>
                            <th>Fraud Check</th>
                            <th>Confirmation</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $key => $order)
                            @php
                                // কাস্টমার ব্লক স্ট্যাটাস চেক করুন
                                $customer = \App\Models\Customer::where('phone', $order->customer_phone)->first();
                                $isBlocked = $customer && $customer->blocked == 1;
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="text-primary">
                                        {{ $order->order_id }}
                                    </a>
                                    @if($isBlocked)
                                        <span class="user-blocked-badge">🚫 Blocked</span>
                                    @endif
                                </td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>৳ {{ number_format($order->total, 2) }}</td>
                                <td>
                                    @php
                                        $statusText = $order->status === 'delivered' ? 'Return' : ucfirst($order->status);
                                    @endphp
                                    <span class="status-badge status-{{ $order->status }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>

                                <td>
                                    @php
                                        $previousOrders = \App\Models\Order::where('customer_phone', $order->customer_phone)
                                            ->where('id', '<', $order->id)
                                            ->count();
                                    @endphp
                                    {{ $previousOrders }}
                                </td>

                                <td>
                                    @if(isset($order->courier_data) && !empty($order->courier_data))
                                        @php
                                            $courierData = is_string($order->courier_data) ? json_decode($order->courier_data, true) : $order->courier_data;
                                        @endphp
                                        @php
                                            $totalParcels = $courierData['summary']['total_parcel'] ?? 0;
                                            $successRatio = $courierData['summary']['success_ratio'] ?? 0;
                                            $isRisky = ($totalParcels > 0 && $successRatio < 69) || (isset($order->is_fraud_risk) && $order->is_fraud_risk);
                                        @endphp
                                        
                                        <div class="fraud-status mb-2">
                                            @if($isRisky)
                                                <span class="badge bg-danger">⚠️ High Risk</span>
                                            @elseif($totalParcels > 0 && $successRatio >= 80)
                                                <span class="badge" style="background: #28a745; color: #fff;">✅ Safe</span>
                                            @elseif($totalParcels > 0)
                                                <span class="badge bg-warning">⚠️ Moderate Risk</span>
                                            @else
                                                <span class="badge bg-secondary">⏳ No Data</span>
                                            @endif
                                        </div>
                                
                                        @if(is_array($courierData) && count($courierData) > 0)
                                            <div class="courier-summary">
                                                @if(isset($courierData['summary']))
                                                    <div class="overall-summary mb-2">
                                                        <strong>Overall Success: {{ $courierData['summary']['success_ratio'] }}%</strong>
                                                        <br>
                                                        <small class="text-muted">
                                                            Total: {{ $courierData['summary']['total_parcel'] }} | 
                                                            Success: {{ $courierData['summary']['success_parcel'] }} | 
                                                            Cancelled: {{ $courierData['summary']['cancelled_parcel'] }}
                                                        </small>
                                                    </div>
                                                @endif
                                                
                                                <div class="courier-details">
                                                    @foreach($courierData as $key => $courier)
                                                        @if($key !== 'summary' && isset($courier['name']) && ($courier['total_parcel'] ?? 0) > 0)
                                                            <div class="courier-item">
                                                                <small>{{ $courier['name'] }}:</small>
                                                                <small class="{{ ($courier['success_ratio'] ?? 0) >= 80 ? 'text-success' : (($courier['success_ratio'] ?? 0) >= 50 ? 'text-warning' : 'text-danger') }}">
                                                                    {{ $courier['success_ratio'] }}%
                                                                </small>
                                                                <small class="text-muted">
                                                                    ({{ $courier['success_parcel'] }}/{{ $courier['total_parcel'] }})
                                                                </small>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    
                                                    @php
                                                        $hasAnyCourierData = false;
                                                        foreach($courierData as $key => $courier) {
                                                            if($key !== 'summary' && ($courier['total_parcel'] ?? 0) > 0) {
                                                                $hasAnyCourierData = true;
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    
                                                    @if(!$hasAnyCourierData)
                                                        <div class="courier-item mb-1">
                                                            <span class="text-muted">No individual courier data available</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">No courier data available</span>
                                        @endif
                                    @else
                                        <span class="text-muted">⏳ Pending</span>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $confirmationStatus = $order->confirmation_status ?? 'unknown';
                                        $isRecallable = in_array($confirmationStatus, ['pending', 'hold', 'timeout', 'busy', 'failed', 'unknown']);
                                    @endphp

                                    @switch($confirmationStatus)
                                        @case('confirmed')
                                        @case('completed')
                                            <span class="confirmation-confirmed">✅ Confirmed</span>
                                            @if ($order->confirmation_dtmf_input)
                                                <br><small class="text-muted">Pressed: {{ $order->confirmation_dtmf_input }}</small>
                                            @endif
                                            @if ($order->confirmation_call_duration)
                                                <br><small class="text-muted">Duration: {{ $order->confirmation_call_duration }}s</small>
                                            @endif
                                        @break

                                        @case('declined')
                                            <span class="confirmation-declined">❌ Declined</span>
                                            @if ($order->confirmation_dtmf_input)
                                                <br><small class="text-muted">Pressed: {{ $order->confirmation_dtmf_input }}</small>
                                            @endif
                                        @break

                                        @case('transferred_to_agent')
                                        @case('transferred')
                                            <span class="confirmation-transferred">📞 Transferred</span>
                                            @if ($order->confirmation_call_duration)
                                                <br><small class="text-muted">Duration: {{ $order->confirmation_call_duration }}s</small>
                                            @endif
                                        @break

                                        @case('no_answer')
                                            <span class="confirmation-no-answer" title="Customer didn't answer the call">📵 No Answer</span>
                                        @break

                                        @case('timeout')
                                            <span class="confirmation-timeout" title="Call timed out without response">⏰ Timeout</span>
                                            @if ($order->confirmation_call_duration)
                                                <br><small class="text-muted">Duration: {{ $order->confirmation_call_duration }}s</small>
                                            @endif
                                        @break

                                        @case('busy')
                                            <span class="confirmation-busy" title="Line was busy">📞 Busy</span>
                                        @break

                                        @case('pending')
                                            <span class="confirmation-pending">⏳ Pending</span>
                                        @break

                                        @case('failed')
                                            <span class="confirmation-failed" title="{{ $order->confirmation_message ?? 'API call failed' }}">💥 Failed</span>
                                            @if ($order->confirmation_message)
                                                <br><small class="text-danger confirmation-tooltip" title="{{ $order->confirmation_message }}">Error details</small>
                                            @endif
                                        @break

                                        @default
                                            <span class="confirmation-unknown">⏳ Not Called</span>
                                    @endswitch

                                    @if ($order->confirmation_called_at)
                                        <br><small class="text-muted" style="font-size: 9px;">
                                            Called: {{ \Carbon\Carbon::parse($order->confirmation_called_at)->format('d-m-Y H:i') }}
                                        </small>
                                    @endif

                                    @if (isset($order->confirmation_recall_count) && $order->confirmation_recall_count > 0)
                                        <br><small class="text-warning" style="font-size: 9px;">
                                            🔄 Recall: {{ $order->confirmation_recall_count }}x
                                            @if ($order->confirmation_last_recall_at)
                                                ({{ \Carbon\Carbon::parse($order->confirmation_last_recall_at)->format('d-m-Y H:i') }})
                                            @endif
                                        </small>
                                    @endif

                                    @if($isRecallable)
                                        <div style="margin-top: 5px;">
                                            <button class="btn btn-warning btn-sm recall-btn" 
                                                    data-order-id="{{ $order->id }}"
                                                    data-phone="{{ $order->customer_phone ?? $order->phone ?? '' }}"
                                                    data-product="{{ $order->product_id ?? 3 }}"
                                                    onclick="recallOrder(this)"
                                                    style="font-size: 11px; padding: 2px 10px;">
                                                <i class="fa fa-phone" aria-hidden="true"></i> Recall
                                            </button>
                                            <div id="recall-status-{{ $order->id }}" style="margin-top: 3px; font-size: 10px;"></div>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="action-buttons" style="display: flex; flex-wrap: wrap; gap: 5px; align-items: center;">
                                        <!-- Details Button -->
                                        <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-info" style="pointer-events: auto; z-index: 999;">
                                            <i class="fa fa-eye"></i> Details
                                        </a>

                                        <!-- Status Dropdown -->
                                        <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm status-select" onchange="this.form.submit()" style="width: auto; min-width: 120px; pointer-events: auto; z-index: 999;">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Return</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                <option value="hold" {{ $order->status == 'hold' ? 'selected' : '' }}>Hold</option>
                                            </select>
                                        </form>

                                        {{-- 🚫 BLOCK USER BUTTON (সিম্পল ফোন ব্লক) --}}
                                        @if(auth()->user()->type == 'admin')
                                            @if($isBlocked)
                                                {{-- ইতিমধ্যে ব্লক থাকলে আনব্লক বাটন দেখান --}}
                                                <button class="btn btn-sm btn-success" 
                                                        onclick="unblockCustomer('{{ $customer->id ?? '' }}', '{{ $order->customer_phone }}', this)"
                                                        style="pointer-events: auto; z-index: 999; cursor: pointer;">
                                                    <i class="fa fa-unlock"></i> Unblock
                                                </button>
                                            @else
                                                {{-- ব্লক বাটন --}}
                                                <button class="btn btn-sm btn-block-user" 
                                                        onclick="blockCustomer('{{ $order->id }}', '{{ $order->customer_phone }}', '{{ $order->customer_name }}', this)"
                                                        data-order-id="{{ $order->id }}"
                                                        data-phone="{{ $order->customer_phone }}"
                                                        style="pointer-events: auto; z-index: 999; cursor: pointer;">
                                                    <i class="fa fa-ban"></i> Block User
                                                </button>
                                            @endif
                                        @endif

                                        {{-- Delete Button --}}
                                        @if (auth()->user()->type == 'admin')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteOrder({{ $order->id }}, '{{ $order->order_id }}')"
                                                    style="pointer-events: auto; z-index: 999; cursor: pointer;">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    /**
     * 🚫 কাস্টমার ব্লক করুন (অর্ডার থেকে)
     */
    function blockCustomer(orderId, phone, name, button) {
        if (!confirm(`আপনি কি ${name} (${phone}) কে ব্লক করতে চান?\n\nএই ইউজার আর অর্ডার করতে পারবে না।`)) {
            return;
        }
        
        button.disabled = true;
        button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Blocking...';
        
        const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
        
        fetch(`/admin/customer/block-from-order/${orderId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '✅ ব্লক করা হয়েছে!',
                    text: data.message,
                    timer: 3000,
                    timerProgressBar: true
                });
                
                setTimeout(() => location.reload(), 2000);
            } else {
                button.innerHTML = '<i class="fa fa-ban"></i> Retry';
                button.disabled = false;
                
                Swal.fire({
                    icon: 'error',
                    title: 'ব্যর্থ!',
                    text: data.message || 'কিছু ভুল হয়েছে'
                });
            }
        })
        .catch(error => {
            console.error('Block error:', error);
            button.innerHTML = '<i class="fa fa-ban"></i> Retry';
            button.disabled = false;
            
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong: ' + error.message
            });
        });
    }
    
    /**
     * 🔓 কাস্টমার আনব্লক করুন
     */
    function unblockCustomer(customerId, phone, button) {
        if (!confirm(`আপনি কি ${phone} কে আনব্লক করতে চান?`)) {
            return;
        }
        
        button.disabled = true;
        button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Unblocking...';
        
        const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
        
        fetch(`/admin/customer/unblock/${customerId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '✅ আনব্লক করা হয়েছে!',
                    text: data.message,
                    timer: 3000,
                    timerProgressBar: true
                });
                
                setTimeout(() => location.reload(), 2000);
            } else {
                 setTimeout(() => location.reload(), 2000);
                // button.innerHTML = '<i class="fa fa-unlock"></i> Unblock';
                // button.disabled = false;
                
                // Swal.fire({
                //     icon: 'error',
                //     title: 'ব্যর্থ!',
                //     text: data.message || 'কিছু ভুল হয়েছে'
                // });
            }
        })
        .catch(error => {
            console.error('Unblock error:', error);
            button.innerHTML = '<i class="fa fa-unlock"></i> Unblock';
            button.disabled = false;
            
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong: ' + error.message
            });
        });
    }
    
    /**
     * 📞 রিকল ফাংশন
     */
    function recallOrder(button) {
        const orderId = button.dataset.orderId;
        const phone = button.dataset.phone;
        const product = button.dataset.product;
        const statusDiv = document.getElementById('recall-status-' + orderId);
        
        if (!phone || phone.trim() === '') {
            statusDiv.innerHTML = '<span class="text-danger">❌ No phone number</span>';
            return;
        }

        button.disabled = true;
        button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Calling...';
        statusDiv.innerHTML = '<span class="text-info">⏳ Calling customer...</span>';

        const token = document.querySelector('meta[name="csrf-token"]')?.content || '';

        fetch('{{ route("recall.order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                order_id: orderId,
                phone: phone,
                product: product
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let html = '<span class="text-success">✅ Call initiated!</span>';
                if (data.data) {
                    html += `<br><small class="text-muted">Status: ${data.data.confirmation_status || 'N/A'}</small>`;
                    if (data.data.dtmf_input) {
                        html += `<br><small class="text-muted">DTMF: ${data.data.dtmf_input}</small>`;
                    }
                    if (data.data.call_duration) {
                        html += `<br><small class="text-muted">Duration: ${data.data.call_duration}s</small>`;
                    }
                    if (data.data.recall_count) {
                        html += `<br><small class="text-warning">🔄 Recall #${data.data.recall_count}</small>`;
                    }
                }
                statusDiv.innerHTML = html;
                button.innerHTML = '<i class="fa fa-check"></i> Called';
                button.disabled = true;
                
                setTimeout(() => location.reload(), 3000);
            } else {
                statusDiv.innerHTML = `<span class="text-danger">❌ ${data.message || 'Call failed'}</span>`;
                button.innerHTML = '<i class="fa fa-phone"></i> Retry';
                button.disabled = false;
            }
        })
        .catch(error => {
            statusDiv.innerHTML = `<span class="text-danger">❌ Error: ${error.message}</span>`;
            button.innerHTML = '<i class="fa fa-phone"></i> Retry';
            button.disabled = false;
        });
    }
    
    /**
     * 🗑️ অর্ডার ডিলিট
     */
    function deleteOrder(id, orderId) {
        if (confirm('Are you sure you want to delete Order #' + orderId + '?')) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '/orders/' + id;
            
            var csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            
            var method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);
            
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

{{-- SweetAlert CDN --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('[title]').tooltip({
                placement: 'top',
                html: true
            });
            
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endpush

@endsection