@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Edit Product</h5>
                    </div>

                    <div class="card-body">
                        @include('components.alert')

                        {!! Form::open(['method' => 'post', 'route' => ['admin.product.update', $product->id], 'files' => true]) !!}
                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label>Name*</label>
                                <input class="form-control" type="text" name="name" value="{{ $product->name }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Category</label>
                                <input class="form-control" type="text" name="category" value="{{ $product->category }}">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Price*</label>
                                <input class="form-control" type="number" step="any" name="price"
                                    value="{{ $product->price }}" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Old Price</label>
                                <input class="form-control" type="number" step="any" name="old_price"
                                    value="{{ $product->old_price }}">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Badge</label>
                                <input class="form-control" type="text" name="badge" value="{{ $product->badge }}">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Rating</label>
                                <input class="form-control" type="number" step="0.1" name="rating"
                                    value="{{ $product->rating }}">
                            </div>

                            <div class="col-md-12 mb-4">
                                <label>Description</label>
                                <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label>Upload New Images (Optional)</label>
                                <input class="form-control" type="file" name="images[]" multiple>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Existing Images</label>
                                <div class="d-flex flex-wrap">

                                    @foreach ($product->images as $img)
                                        <div class="me-2 mb-2" style="position: relative; display: inline-block;">
                                            <img src="{{ asset($img) }}" width="90" height="90"
                                                style="object-fit: cover; border: 1px solid #ddd; padding: 2px;">

                                            {{-- Delete Single Image Button --}}
                                            <a href="{{ route('admin.product.image.delete', ['id' => $product->id, 'image' => $img]) }}"
                                                class="btn btn-danger btn-sm"
                                                style="
                                                position:absolute;
                                                top:-8px; 
                                                right:-8px; 
                                                border-radius:50%;
                                                padding:2px 6px;
                                           ">
                                                ×
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-primary">Update</button>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
