@extends('admin.masterAdmin')
@section('content')

  @php
    $settings = App\Models\Setting::first();

    // Product data with fixed prices
    $products = [
      ['id' => 'combo1', 'name' => 'মসলা কম্বো ১', 'price' => 999, 'display' => 'মসলা কম্বো ১'],
      ['id' => 'combo2', 'name' => 'মসলা কম্বো ২', 'price' => 1399, 'display' => 'মসলা কম্বো ২'],
      ['id' => 'combo3', 'name' => 'মসলা কম্বো ৩', 'price' => 1699, 'display' => 'মসলা কম্বো ৩'],
      ['id' => 'pickle', 'name' => 'রসুন, আম, তেঁতুল ও জলপাইের আচার', 'price' => 1099, 'display' => 'রসুন, আম, তেঁতুল ও জলপাইের আচার']
    ];

    // Parse current product
    $currentProduct = $order->product;
    $selectedProductId = 'combo1';
    $productQty = 1;
    $currentPrice = $order->subtotal;
    $pickleQty = 1;

    // Check if order has quantity field
    $orderQty = $order->quantity ?? 1;

    if (strpos($currentProduct, 'আচার') !== false) {
      $selectedProductId = 'pickle';
      preg_match('/\((\d+)\s*পিস\)/', $currentProduct, $matches);
      $pickleQty = $matches[1] ?? $orderQty;
      $productQty = $pickleQty;
      $currentPrice = 1099 * $pickleQty;
    } else {
      foreach ($products as $p) {
        if ($p['id'] != 'pickle' && strpos($currentProduct, $p['name']) !== false) {
          $selectedProductId = $p['id'];
          $currentPrice = $p['price'];
          $productQty = $orderQty; // Use order quantity for combos too
          break;
        }
      }
    }

    // Get current unit price
    $currentUnitPrice = 0;
    foreach ($products as $p) {
      if ($p['id'] == $selectedProductId) {
        $currentUnitPrice = $p['price'];
        break;
      }
    }

    // If product not found in combos, set default
    if ($currentUnitPrice == 0) {
      $currentUnitPrice = 999;
      $selectedProductId = 'combo1';
      $productQty = $orderQty;
      $currentPrice = 999 * $orderQty;
    }
  @endphp

  <style>
    /* Print Styles - Hide edit elements */
    @media print {
      .no-print {
        display: none !important;
      }

      .edit-mode {
        display: none !important;
      }

      .editing .edit-mode {
        display: none !important;
      }

      .editing .view-mode {
        display: block !important;
      }

      .card {
        border: none !important;
        box-shadow: none !important;
      }

      .card-body {
        padding: 10px !important;
      }

      .print-logo {
        display: block !important;
      }

      .print-border {
        border: 1px solid #000 !important;
      }

      .status-badge {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }

      body {
        background: #fff !important;
      }

      .table-bordered,
      .table-bordered th,
      .table-bordered td {
        border: 1px solid #000 !important;
      }

      .invoice-title {
        font-size: 18px !important;
      }

      .invoice-subtitle {
        font-size: 14px !important;
      }

      .product-option {
        display: none !important;
      }

      #quantitySection {
        display: none !important;
      }

      .border-custom {
        border: 1px solid #000 !important;
      }
    }

    /* Screen Styles */
    .print-logo {
      display: none;
    }

    .status-badge {
      padding: 5px 12px;
      border-radius: 5px;
      font-weight: bold;
      display: inline-block;
    }

    .status-pending {
      background: #ffc107;
      color: #000;
    }

    .status-processing {
      background: #17a2b8;
      color: #fff;
    }

    .status-shipped {
      background: #007bff;
      color: #fff;
    }

    .status-delivered {
      background: #28a745;
      color: #fff;
    }

    .status-completed {
      background: #28a745;
      color: #fff;
    }

    .status-cancelled {
      background: #dc3545;
      color: #fff;
    }

    .border-custom {
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
    }

    .product-option {
      padding: 10px;
      border: 2px solid #dee2e6;
      border-radius: 8px;
      margin-bottom: 8px;
      cursor: pointer;
      transition: all 0.3s;
      background: white;
    }

    .product-option:hover {
      border-color: #007bff;
      background: #f8f9fa;
    }

    .product-option.selected {
      border-color: #28a745;
      background: #d4edda;
    }

    .product-option .price {
      font-weight: bold;
      color: #28a745;
    }

    .edit-mode {
      display: none;
    }

    .editing .edit-mode {
      display: block;
    }

    .editing .view-mode {
      display: none;
    }

    .invoice-box {
      padding: 20px;
      border: 2px solid #000;
      border-radius: 10px;
      background: white;
    }

    .btn i {
      margin-right: 5px;
    }

    .table th,
    .table td {
      border: 1px solid #000 !important;
    }

    .summary-table th,
    .summary-table td {
      border: 1px solid #000 !important;
    }

    .quantity-input {
      max-width: 100px;
    }

    .select2-container {
      width: 100% !important;
    }

    .select2-selection--single {
      height: 38px !important;
      display: flex !important;
      align-items: center !important;
    }
  </style>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center no-print">
      <h5 class="mb-0">Order Details - {{ $order->order_id }}</h5>
      <div>
        <button type="button" onclick="printInvoice()" class="btn btn-success btn-sm me-2">
          <i class="fa fa-print"></i> Print Invoice
        </button>
        <button type="button" onclick="toggleEdit()" class="btn btn-primary btn-sm me-2" id="editBtn">
          <i class="fa fa-edit"></i> Edit Order
        </button>
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary btn-sm">
          <i class="fa fa-arrow-left"></i> Back
        </a>
      </div>
    </div>

    <div class="card-body" id="printArea">

      <!-- Print Logo -->
      <div class="text-center mb-4 print-logo">
        @if($settings && $settings->logo)
          <img src="{{ asset('settings/' . $settings->logo) }}" width="150" alt="Logo" class="mb-2">
        @endif
        <h3 class="invoice-title">সেরা বাংলা ৬৪</h3>
        <p class="invoice-subtitle">Customer Order Invoice</p>
        <hr>
      </div>

      <!-- Web Logo -->
      <div class="text-center mb-4 d-block d-print-none">
        @if($settings && $settings->logo)
          <img src="{{ asset('settings/' . $settings->logo) }}" width="120" alt="logo" class="mb-2">
        @endif
        <h4>সেরা বাংলা ৬৪</h4>
      </div>
      <div class="text-start mb-4 d-block ">
        <h4>Courier ID: {{ $order->courier_id  }}</h4>
      </div>

      <!-- Edit/Save Controls -->
      <div class="no-print text-center mb-3">
        <button onclick="saveOrder()" class="btn btn-success btn-sm d-none" id="saveBtn">
          <i class="fa fa-save"></i> Save Changes
        </button>
        <button onclick="location.reload()" class="btn btn-danger btn-sm d-none" id="cancelBtn">
          <i class="fa fa-times"></i> Cancel
        </button>
      </div>

      <form id="orderForm">
        @csrf
        @method('PUT')

        <div class="invoice-box">
          <div class="row">
            <!-- Customer Information -->
            <div class="col-md-6">
              <div class="border-custom">
                <h6 class="fw-bold mb-3">Customer Information</h6>

                <div class="view-mode">
                  <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
                  <p><strong>Name:</strong> <span id="view-name">{{ $order->customer_name }}</span></p>
                  <p><strong>Phone:</strong> <span id="view-phone">{{ $order->customer_phone }}</span></p>
                  <p><strong>Address:</strong> <span id="view-address">{{ $order->customer_address }}</span></p>
                  <p><strong>Order Note:</strong> {{ $order->order_note ?? 'N/A' }}</p>
                  <p><strong>Scratch Card Number:</strong> {{ $order->gift->name ?? 'N/A' }}</p>
                </div>

                <div class="edit-mode">
                  <div class="mb-2">
                    <label class="form-label">Order ID</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $order->order_id }}" readonly>
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Name *</label>
                    <input type="text" class="form-control form-control-sm" name="customer_name"
                      value="{{ $order->customer_name }}" required>
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Phone *</label>
                    <input type="text" class="form-control form-control-sm" name="customer_phone"
                      value="{{ $order->customer_phone }}" required>
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Address *</label>
                    <textarea class="form-control form-control-sm" name="customer_address" rows="2"
                      required>{{ $order->customer_address }}</textarea>
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Order Note</label>
                    <textarea class="form-control form-control-sm" name="order_note"
                      rows="2">{{ $order->order_note }}</textarea>
                  </div>
                </div>
              </div>
            </div>

            <!-- Order Information -->
            <div class="col-md-6">
              <div class="border-custom">
                <h6 class="fw-bold mb-3">Order Information</h6>

                <div class="view-mode">
                  <p><strong>Date:</strong> {{ $order->created_at->format('d M Y h:i A') }}</p>
                  <p>
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $order->status }}" id="statusBadge">
                      {{ $order->getStatusLabel() }}
                    </span>
                  </p>
                  <p><strong>Product:</strong> <span id="view-product">{{ $order->product }}</span></p>
                  <p><strong>Total:</strong> ৳ <span id="view-total">{{ number_format($order->total, 2) }}</span></p>
                  @if($order->user)
                    <p><strong>Processed By:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                  @endif
                  <br>
                </div>

                <div class="edit-mode">
                  <div class="mb-2">
                    <label class="form-label">Status</label>
                    <select class="form-control form-control-sm" name="status" id="statusSelect">
                      <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                        Pending</option>
                      <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                        Processing</option>
                      <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                        Shipped</option>
                      <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                        Delivered</option>
                      <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                        Completed</option>
                      <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                        Cancelled</option>
                    </select>
                  </div>
                  <div class="form-group mt-2">
                    <label class="form-label d-block mb-2">
                      Scratch Card Number
                    </label>

                    <select class="form-control select2_demo w-100" id="gift_id" name="gift_id" required>
                      <option value="">Select an option</option>

                      @foreach ($gifts as $gift)
                        <option value="{{ $gift->id }}" {{ isset($order) && $order->gift_id == $gift->id ? 'selected' : '' }}>
                          {{ $gift->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Courier Id</label>
                    <input type="text" class="form-control" placeholder="Enter courier Id" name="courier_id"
                      id="courier_id" value="{{ old('courier_id', $order->courier_id ?? '') }}">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product Section -->
          <div class="border-custom mt-3">
            <h6 class="fw-bold mb-3">Product Details</h6>

            <!-- View Mode -->
            <div class="view-mode">
              <table class="table table-bordered">
                <thead class="table-light">
                  <tr>
                    <th width="60" class="text-center">SL</th>
                    <th>Product Name</th>
                    <th width="120" class="text-center">Price</th>
                    <th width="80" class="text-center">Qty</th>
                    <th width="120" class="text-center">Total</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $productDetails = $order->getProductDetails();
                  @endphp
                  <tr>
                    <td class="text-center">1</td>
                    <td>{{ $productDetails['name'] }}</td>
                    <td class="text-center">৳ {{ number_format($productDetails['price'], 2) }}</td>
                    <td class="text-center">{{ $productDetails['quantity'] }}</td>
                    <td class="text-center">৳
                      {{ number_format($productDetails['price'] * $productDetails['quantity'], 2) }}
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr class="fw-bold">
                    <td colspan="4" class="text-end">Subtotal:</td>
                    <td class="text-center">৳ {{ number_format($order->subtotal, 2) }}</td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <!-- Edit Mode -->
            <div class="edit-mode">
              <!-- Product Selection -->
              <div class="row">
                @foreach($products as $product)
                  <div class="col-md-3">
                    <div class="product-option {{ $selectedProductId == $product['id'] ? 'selected' : '' }}"
                      onclick="selectProduct(this, '{{ $product['id'] }}', {{ $product['price'] }}, '{{ $product['display'] }}')">
                      <div class="d-flex justify-content-between">
                        <small><strong>{{ $product['name'] }}</strong></small>
                        <span class="price">৳ {{ $product['price'] }}</span>
                      </div>
                      <input type="radio" name="product_id" value="{{ $product['id'] }}" {{ $selectedProductId == $product['id'] ? 'checked' : '' }} class="d-none">
                    </div>
                  </div>
                @endforeach
              </div>

              <!-- Quantity and Price Section (Same for all products) -->
              <div class="row mt-3" id="quantitySection">
                <div class="col-md-3">
                  <label class="form-label">Quantity</label>
                  <input type="number" class="form-control form-control-sm quantity-input" id="productQty"
                    value="{{ $productQty }}" min="1" step="1">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Price per unit</label>
                  <input type="text" class="form-control form-control-sm" id="unitPriceDisplay"
                    value="৳ {{ number_format($currentUnitPrice, 2) }}" readonly>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Total Price</label>
                  <input type="text" class="form-control form-control-sm" id="productTotalDisplay"
                    value="৳ {{ number_format($currentPrice, 2) }}" readonly>
                </div>
              </div>

              <input type="hidden" name="product_price" id="productPrice" value="{{ $currentPrice }}">
              <input type="hidden" name="unit_price" id="unitPrice" value="{{ $currentUnitPrice }}">
              <input type="hidden" name="product_display" id="productDisplay" value="{{ $currentProduct }}">
              <input type="hidden" name="product_qty" id="productQtyHidden" value="{{ $productQty }}">
            </div>
          </div>

          <!-- Summary -->
          <div class="row justify-content-end mt-3">
            <div class="col-md-4">
              <table class="table table-bordered summary-table">
                <tr>
                  <th>Subtotal</th>
                  <td class="text-end">৳ <span id="subtotalDisplay">{{ number_format($order->subtotal, 2) }}</span></td>
                </tr>
                <tr>
                  <th>Delivery</th>
                  <td class="text-end">৳ <span
                      id="deliveryDisplay">{{ number_format($order->delivery_charge ?? 0, 2) }}</span>
                  </td>
                </tr>
                @if ($order->discount > 0)

                  <tr>
                    <th>Discount</th>
                    <td class="text-end">৳ <span id="discountDisplay">{{ number_format($order->discount ?? 0, 2) }}</span>
                    </td>
                  </tr>
                @endif
                <tr class="fw-bold">
                  <th>Total</th>
                  <td class="text-end">৳ <span id="totalDisplay">{{ number_format($order->total, 2) }}</span></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </form>

      <!-- Footer for Print -->
      <div class="text-center print-logo mt-4">
        <hr>
        <p class="small">Thank you for your order!</p>
        <p class="small">সেরা বাংলা ৬৪- #সেরা বাংলার, সেরা পণ্য</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // Product data
    const products = {
      'combo1': { price: 999, display: 'মসলা কম্বো ১' },
      'combo2': { price: 1399, display: 'মসলা কম্বো ২' },
      'combo3': { price: 1699, display: 'মসলা কম্বো ৩' },
      'pickle': { price: 1099, display: 'রসুন, আম, তেঁতুল ও জলপাইের আচার' }
    };

    let selectedProduct = '{{ $selectedProductId }}';
    let productPrice = {{ $currentPrice }};
    let productDisplay = '{{ $currentProduct }}';
    let productQty = {{ $productQty }};
    let unitPrice = {{ $currentUnitPrice }};
    let isEditing = false;

    // Initialize
    document.addEventListener('DOMContentLoaded', function () {
      updateProductTotal();
      updateSummary();
    });

    // Toggle edit mode
    function toggleEdit() {
      isEditing = !isEditing;
      document.querySelector('.card-body').classList.toggle('editing');

      const btn = document.getElementById('editBtn');
      const saveBtn = document.getElementById('saveBtn');
      const cancelBtn = document.getElementById('cancelBtn');

      if (isEditing) {
        btn.innerHTML = '<i class="fa fa-eye"></i> View Mode';
        btn.className = 'btn btn-secondary btn-sm';
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
      } else {
        btn.innerHTML = '<i class="fa fa-edit"></i> Edit Order';
        btn.className = 'btn btn-primary btn-sm';
        saveBtn.classList.add('d-none');
        cancelBtn.classList.add('d-none');
      }
    }

    // Select product
    function selectProduct(element, id, price, display) {
      // Update UI
      document.querySelectorAll('.product-option').forEach(el => el.classList.remove('selected'));
      element.classList.add('selected');
      element.querySelector('input[type="radio"]').checked = true;

      // Update data
      selectedProduct = id;
      unitPrice = price;
      productDisplay = display;

      // Update unit price display
      document.getElementById('unitPriceDisplay').value = '৳ ' + price.toFixed(2);

      // Reset quantity to 1 when switching products
      document.getElementById('productQty').value = 1;
      productQty = 1;

      // Update totals
      updateProductTotal();
      updateSummary();
    }

    // Update product total
    function updateProductTotal() {
      const qty = parseInt(document.getElementById('productQty').value) || 1;
      productQty = qty;

      let total = unitPrice * qty;

      // Special display for pickle
      if (selectedProduct === 'pickle') {
        productDisplay = `রসুন, আম, তেঁতুল ও জলপাইের আচার (${qty} পিস)`;
      } else {
        // For combos, just show product name
        productDisplay = products[selectedProduct].display;
      }

      document.getElementById('productTotalDisplay').value = '৳ ' + total.toFixed(2);
      document.getElementById('productPrice').value = total;
      document.getElementById('unitPrice').value = unitPrice;
      document.getElementById('productDisplay').value = productDisplay;
      document.getElementById('productQtyHidden').value = qty;
    }

    // Update summary
    function updateSummary() {
      const subtotal = parseFloat(document.getElementById('productPrice').value) || productPrice;
      const delivery = parseFloat(document.getElementById('deliveryCharge').value) || 0;
      const total = subtotal + delivery;

      document.getElementById('subtotalDisplay').textContent = subtotal.toFixed(2);
      document.getElementById('deliveryDisplay').textContent = delivery.toFixed(2);
      document.getElementById('totalDisplay').textContent = total.toFixed(2);

      // Update view mode
      document.getElementById('view-product').textContent = document.getElementById('productDisplay').value;
      document.getElementById('view-total').textContent = total.toFixed(2);
    }

    // Event listeners
    document.getElementById('productQty')?.addEventListener('change', function () {
      updateProductTotal();
      updateSummary();
    });

    document.getElementById('productQty')?.addEventListener('input', function () {
      updateProductTotal();
      updateSummary();
    });

    document.getElementById('deliveryCharge')?.addEventListener('input', function () {
      updateSummary();
    });

    document.getElementById('statusSelect')?.addEventListener('change', function () {
      const badge = document.getElementById('statusBadge');
      const status = this.value;
      const labels = {
        'pending': 'Pending',
        'processing': 'Processing',
        'shipped': 'Shipped',
        'delivered': 'Delivered',
        'completed': 'Completed',
        'cancelled': 'Cancelled'
      };
      badge.className = 'status-badge status-' + status;
      badge.textContent = labels[status] || status;
    });

    // Save order
    function saveOrder() {
      const form = document.getElementById('orderForm');
      const formData = new FormData(form);

      // Validate
      if (!formData.get('customer_name')?.trim()) {
        Swal.fire('Error', 'Customer name is required', 'error');
        return;
      }
      if (!formData.get('customer_phone')?.trim()) {
        Swal.fire('Error', 'Customer phone is required', 'error');
        return;
      }
      if (!formData.get('customer_address')?.trim()) {
        Swal.fire('Error', 'Customer address is required', 'error');
        return;
      }

      // Add product data
      formData.set('product_price', document.getElementById('productPrice').value);
      formData.set('product_display', document.getElementById('productDisplay').value);
      formData.set('product_qty', document.getElementById('productQtyHidden').value);

      Swal.fire({
        title: 'Saving...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });

      fetch('{{ route("admin.order.updateFull", $order->id) }}', {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Order updated successfully',
              timer: 1500,
              showConfirmButton: false
            });
            setTimeout(() => location.reload(), 1500);
          } else {
            Swal.fire('Error', data.message || 'Failed to update', 'error');
          }
        })
        .catch(() => {
          Swal.fire('Error', 'Something went wrong', 'error');
        });
    }

    // Print invoice with proper formatting
    function printInvoice() {
      const orderId = '{{ $order->order_id }}';
      const printContents = document.getElementById('printArea').innerHTML;

      // Create print window
      const printWindow = window.open('', '_blank', 'width=800,height=600');

      printWindow.document.write(`
                              <!DOCTYPE html>
                              <html>
                              <head>
                                  <title>Invoice - ${orderId}</title>
                                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
                                  <style>
                                      body { padding: 20px; background: #fff; }
                                      .no-print { display: none !important; }
                                      .print-logo { display: block !important; }
                                      .edit-mode { display: none !important; }
                                      .editing .edit-mode { display: none !important; }
                                      .editing .view-mode { display: block !important; }
                                      .status-badge { 
                                          padding: 5px 12px;
                                          border-radius: 5px;
                                          font-weight: bold;
                                          display: inline-block;
                                          -webkit-print-color-adjust: exact !important;
                                          print-color-adjust: exact !important;
                                      }
                                      .status-pending { background: #ffc107; color: #000; }
                                      .status-processing { background: #17a2b8; color: #fff; }
                                      .status-shipped { background: #007bff; color: #fff; }
                                      .status-delivered { background: #28a745; color: #fff; }
                                      .status-completed { background: #28a745; color: #fff; }
                                      .status-cancelled { background: #dc3545; color: #fff; }
                                      .table-bordered, .table-bordered th, .table-bordered td {
                                          border: 1px solid #000 !important;
                                      }
                                      .border-custom {
                                          border: 1px solid #000 !important;
                                          padding: 15px;
                                          margin-bottom: 15px;
                                      }
                                      .invoice-box {
                                          padding: 20px;
                                          border: 2px solid #000;
                                          border-radius: 10px;
                                      }
                                      .summary-table th, .summary-table td {
                                          border: 1px solid #000 !important;
                                      }
                                      .card { border: none !important; box-shadow: none !important; }
                                      .card-body { padding: 10px !important; }
                                      .product-option { display: none !important; }
                                      #quantitySection { display: none !important; }
                                  </style>
                              </head>
                              <body>
                                  <div class="container">
                                      ${printContents}
                                  </div>
                                  <script>
                                      window.onload = function() {
                                          window.print();
                                          window.close();
                                      }
                                  <\/script>
                              </body>
                              </html>
                          `);

      printWindow.document.close();
    }

    // Status update function
    function updateStatus(status) {
      const statusLabels = {
        'pending': 'Pending',
        'processing': 'Processing',
        'shipped': 'Shipped',
        'delivered': 'Delivered',
        'completed': 'Completed',
        'cancelled': 'Cancelled'
      };

      if (!confirm('Are you sure you want to update order status to ' + statusLabels[status] + '?')) {
        return;
      }

      Swal.fire({
        title: 'Updating...',
        text: 'Please wait',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });

      fetch('{{ route("admin.order.updateStatus", $order->id) }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const statusBadge = document.querySelector('.status-badge');
            if (statusBadge) {
              statusBadge.className = 'status-badge status-' + status;
              statusBadge.textContent = statusLabels[status];
            }
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Order status updated to ' + statusLabels[status],
              timer: 2000,
              showConfirmButton: false
            });
            setTimeout(() => location.reload(), 2000);
          } else {
            Swal.fire('Error', data.message || 'Failed to update order status.', 'error');
          }
        })
        .catch(() => {
          Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
        });
    }
  </script>

  {{--
  <script>
    // Product data
    const products = {
      'combo1': { price: 999, display: 'মসলা কম্বো ১' },
      'combo2': { price: 1399, display: 'মসলা কম্বো ২' },
      'combo3': { price: 1699, display: 'মসলা কম্বো ৩' },
      'pickle': { price: 1099, display: 'রসুন, আম, তেঁতুল ও জলপাইের আচার' }
    };

    let selectedProduct = '{{ $selectedProductId }}';
    let productPrice = {{ $currentPrice }};
    let productDisplay = '{{ $currentProduct }}';
    let productQty = {{ $productQty }};
    let unitPrice = {{ $currentUnitPrice }};
    let isEditing = false;

    // Initialize
    document.addEventListener('DOMContentLoaded', function () {
      updateProductTotal();
      updateSummary();
    });

    // Toggle edit mode
    function toggleEdit() {
      isEditing = !isEditing;
      document.querySelector('.card-body').classList.toggle('editing');

      const btn = document.getElementById('editBtn');
      const saveBtn = document.getElementById('saveBtn');
      const cancelBtn = document.getElementById('cancelBtn');

      if (isEditing) {
        btn.innerHTML = '<i class="fa fa-eye"></i> View Mode';
        btn.className = 'btn btn-secondary btn-sm';
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
      } else {
        btn.innerHTML = '<i class="fa fa-edit"></i> Edit Order';
        btn.className = 'btn btn-primary btn-sm';
        saveBtn.classList.add('d-none');
        cancelBtn.classList.add('d-none');
      }
    }

    // Select product
    function selectProduct(element, id, price, display) {
      // Update UI
      document.querySelectorAll('.product-option').forEach(el => el.classList.remove('selected'));
      element.classList.add('selected');
      element.querySelector('input[type="radio"]').checked = true;

      // Update data
      selectedProduct = id;
      unitPrice = price;
      productDisplay = display;

      // Update unit price display
      document.getElementById('unitPriceDisplay').value = '৳ ' + price.toFixed(2);

      // Reset quantity to 1 when switching products
      document.getElementById('productQty').value = 1;
      productQty = 1;

      // Update totals
      updateProductTotal();
      updateSummary();
    }

    // Update product total
    function updateProductTotal() {
      const qty = parseInt(document.getElementById('productQty').value) || 1;
      productQty = qty;

      let total = unitPrice * qty;

      // Special display for pickle
      if (selectedProduct === 'pickle') {
        productDisplay = `রসুন, আম, তেঁতুল ও জলপাইের আচার (${qty} পিস)`;
      } else {
        // For combos, just show product name
        productDisplay = products[selectedProduct].display;
      }

      document.getElementById('productTotalDisplay').value = '৳ ' + total.toFixed(2);
      document.getElementById('productPrice').value = total;
      document.getElementById('productDisplay').value = productDisplay;
      document.getElementById('productQtyHidden').value = qty;
    }

    // Update summary
    function updateSummary() {
      const subtotal = parseFloat(document.getElementById('productPrice').value) || productPrice;
      const delivery = parseFloat(document.getElementById('deliveryCharge').value) || 0;
      const total = subtotal + delivery;

      document.getElementById('subtotalDisplay').textContent = subtotal.toFixed(2);
      document.getElementById('deliveryDisplay').textContent = delivery.toFixed(2);
      document.getElementById('totalDisplay').textContent = total.toFixed(2);

      // Update view mode
      document.getElementById('view-product').textContent = document.getElementById('productDisplay').value;
      document.getElementById('view-total').textContent = total.toFixed(2);
    }

    // Event listeners
    document.getElementById('productQty')?.addEventListener('change', function () {
      updateProductTotal();
      updateSummary();
    });

    document.getElementById('productQty')?.addEventListener('input', function () {
      updateProductTotal();
      updateSummary();
    });

    document.getElementById('deliveryCharge')?.addEventListener('input', function () {
      updateSummary();
    });

    document.getElementById('statusSelect')?.addEventListener('change', function () {
      const badge = document.getElementById('statusBadge');
      const status = this.value;
      const labels = {
        'pending': 'Pending',
        'processing': 'Processing',
        'shipped': 'Shipped',
        'delivered': 'Delivered',
        'completed': 'Completed',
        'cancelled': 'Cancelled'
      };
      badge.className = 'status-badge status-' + status;
      badge.textContent = labels[status] || status;
    });

    // Save order
    function saveOrder() {
      const form = document.getElementById('orderForm');
      const formData = new FormData(form);

      // Validate
      if (!formData.get('customer_name')?.trim()) {
        Swal.fire('Error', 'Customer name is required', 'error');
        return;
      }
      if (!formData.get('customer_phone')?.trim()) {
        Swal.fire('Error', 'Customer phone is required', 'error');
        return;
      }
      if (!formData.get('customer_address')?.trim()) {
        Swal.fire('Error', 'Customer address is required', 'error');
        return;
      }

      // Add product data
      formData.set('product_price', document.getElementById('productPrice').value);
      formData.set('product_display', document.getElementById('productDisplay').value);
      formData.set('product_qty', document.getElementById('productQtyHidden').value);

      Swal.fire({
        title: 'Saving...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });

      fetch('{{ route("admin.order.updateFull", $order->id) }}', {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Order updated successfully',
              timer: 1500,
              showConfirmButton: false
            });
            setTimeout(() => location.reload(), 1500);
          } else {
            Swal.fire('Error', data.message || 'Failed to update', 'error');
          }
        })
        .catch(() => {
          Swal.fire('Error', 'Something went wrong', 'error');
        });
    }

    // Print invoice with proper formatting
    function printInvoice() {
      const orderId = '{{ $order->order_id }}';
      const printContents = document.getElementById('printArea').innerHTML;

      // Create print window
      const printWindow = window.open('', '_blank', 'width=800,height=600');

      printWindow.document.write(`
                                                          <!DOCTYPE html>
                                                          <html>
                                                          <head>
                                                              <title>Invoice - ${orderId}</title>
                                                              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                              <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
                                                              <style>
                                                                  body { padding: 20px; background: #fff; }
                                                                  .no-print { display: none !important; }
                                                                  .print-logo { display: block !important; }
                                                                  .edit-mode { display: none !important; }
                                                                  .editing .edit-mode { display: none !important; }
                                                                  .editing .view-mode { display: block !important; }
                                                                  .status-badge { 
                                                                      padding: 5px 12px;
                                                                      border-radius: 5px;
                                                                      font-weight: bold;
                                                                      display: inline-block;
                                                                      -webkit-print-color-adjust: exact !important;
                                                                      print-color-adjust: exact !important;
                                                                  }
                                                                  .status-pending { background: #ffc107; color: #000; }
                                                                  .status-processing { background: #17a2b8; color: #fff; }
                                                                  .status-shipped { background: #007bff; color: #fff; }
                                                                  .status-delivered { background: #28a745; color: #fff; }
                                                                  .status-completed { background: #28a745; color: #fff; }
                                                                  .status-cancelled { background: #dc3545; color: #fff; }
                                                                  .table-bordered, .table-bordered th, .table-bordered td {
                                                                      border: 1px solid #000 !important;
                                                                  }
                                                                  .border-custom {
                                                                      border: 1px solid #000 !important;
                                                                      padding: 15px;
                                                                      margin-bottom: 15px;
                                                                  }
                                                                  .invoice-box {
                                                                      padding: 20px;
                                                                      border: 2px solid #000;
                                                                      border-radius: 10px;
                                                                  }
                                                                  .summary-table th, .summary-table td {
                                                                      border: 1px solid #000 !important;
                                                                  }
                                                                  .card { border: none !important; box-shadow: none !important; }
                                                                  .card-body { padding: 10px !important; }
                                                                  .product-option { display: none !important; }
                                                                  #quantitySection { display: none !important; }
                                                              </style>
                                                          </head>
                                                          <body>
                                                              <div class="container">
                                                                  ${printContents}
                                                              </div>
                                                              <script>
                                                                  window.onload = function() {
                                                                      window.print();
                                                                      window.close();
                                                                  }
                                                              <\/script>
                                                          </body>
                                                          </html>
                                                      `);

      printWindow.document.close();
    }

    // Status update function
    function updateStatus(status) {
      const statusLabels = {
        'pending': 'Pending',
        'processing': 'Processing',
        'shipped': 'Shipped',
        'delivered': 'Delivered',
        'completed': 'Completed',
        'cancelled': 'Cancelled'
      };

      if (!confirm('Are you sure you want to update order status to ' + statusLabels[status] + '?')) {
        return;
      }

      Swal.fire({
        title: 'Updating...',
        text: 'Please wait',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });

      fetch('{{ route("admin.order.updateStatus", $order->id) }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const statusBadge = document.querySelector('.status-badge');
            if (statusBadge) {
              statusBadge.className = 'status-badge status-' + status;
              statusBadge.textContent = statusLabels[status];
            }
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Order status updated to ' + statusLabels[status],
              timer: 2000,
              showConfirmButton: false
            });
            setTimeout(() => location.reload(), 2000);
          } else {
            Swal.fire('Error', data.message || 'Failed to update order status.', 'error');
          }
        })
        .catch(() => {
          Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
        });
    }
  </script> --}}

@endsection