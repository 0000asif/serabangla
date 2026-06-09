@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Add Product</h5>
                    </div>
                    <div class="card-body">

                        @include('components.alert')

                        {!! Form::open(['method' => 'post', 'route' => 'admin.product.store', 'files' => true]) !!}
                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label>Name*</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Category</label>
                                <input class="form-control" type="text" name="category">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Price*</label>
                                <input class="form-control" type="number" step="any" name="price" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Old Price</label>
                                <input class="form-control" type="number" step="any" name="old_price">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Badge</label>
                                <input class="form-control" type="text" name="badge">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Rating</label>
                                <input class="form-control" type="number" step="0.1" name="rating">
                            </div>

                            <div class="col-md-12 mb-4">
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label>Images (Multiple)*</label>
                                <input class="form-control" type="file" name="images[]" multiple>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
                                </select>
                            </div>

                        </div>

                        <button class="btn btn-primary">Submit</button>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
