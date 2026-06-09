@extends('admin.masterAdmin')

@section('content')

<div class="card">
    <div class="card-header">
        <h5>Add Review</h5>
    </div>

    <div class="card-body">

        @include('components.alert')

        {!! Form::open(['route' => 'reviews.store', 'method' => 'post', 'files' => true]) !!}

        <div class="row">

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Name *</label>
                    <input class="form-control" type="text" name="name" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>City *</label>
                    <input class="form-control" type="text" name="city" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Rating (0 - 5) *</label>
                    <input class="form-control" type="number" name="rating" step="0.1" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Image *</label>
                    <input class="form-control" type="file" name="image" required>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-4">
                    <label>Description *</label>
                    <textarea class="form-control" name="desc" required></textarea>
                </div>
            </div>

        </div>

        <button class="btn btn-primary" type="submit">Submit</button>

        {!! Form::close() !!}

    </div>
</div>

@endsection
