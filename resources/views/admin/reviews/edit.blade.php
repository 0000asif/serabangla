@extends('admin.masterAdmin')

@section('content')

<div class="card">
    <div class="card-header">
        <h5>Edit Review</h5>
    </div>

    <div class="card-body">

        @include('components.alert')

        {!! Form::open(['route' => ['reviews.update', $review->id], 'method' => 'put', 'files' => true]) !!}

        <div class="row">

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Name *</label>
                    <input class="form-control" type="text" name="name" value="{{ $review->name }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>City *</label>
                    <input class="form-control" type="text" name="city" value="{{ $review->city }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Rating *</label>
                    <input class="form-control" type="number" step="0.1" name="rating" value="{{ $review->rating }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <label>Image</label>
                <input class="form-control" type="file" name="image">
                <img src="{{ asset('reviews/' . $review->image) }}" width="80" class="mt-2 img-thumbnail">
            </div>

            <div class="col-md-12">
                <div class="form-group mb-4">
                    <label>Description *</label>
                    <textarea class="form-control" name="desc" required>{{ $review->desc }}</textarea>
                </div>
            </div>

        </div>

        <button class="btn btn-primary" type="submit">Update</button>

        {!! Form::close() !!}

    </div>
</div>

@endsection
