@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Product List</h5>
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">+ Add Product</a>
            </div>

            <div class="card-body">
                @include('components.alert')


                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">

                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>৳ {{ $product->price }}</td>
                                    <td>{{ $product->category  ?? 'N/A'}}</td>
                                    <td>
                                        @if ($product->images)
                                            <img src="{{ asset($product->images[0]) }}" width="60">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->status == 'active')
                                            <div class="badge badge-success">Active</div>
                                        @else
                                            <div class="badge badge-danger">InActive</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.product.delete', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
