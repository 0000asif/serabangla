@extends('admin.masterAdmin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-fullheight">
            <div class="card-header">
                <h5 class="box-title">Update Hero Section</h5>
            </div>
            <div class="card-body">

                @include('components.alert')

                {!! Form::open(['route' => ['hero.update', $hero->id], 'method' => 'post', 'files' => true]) !!}
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Badge <span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="badge"
                                   value="{{ old('badge', $hero->badge) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Title <span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="title"
                                   value="{{ old('title', $hero->title) }}" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Subtitle</label>
                            <textarea class="form-control" name="subtitle">{{ old('subtitle', $hero->subtitle) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Image</label>
                            <input class="form-control" type="file" name="image">
                            @if($hero->image)
                                <img src="{{ asset('heroes/'.$hero->image) }}" class="img-thumbnail mt-2" width="120">
                            @endif
                        </div>
                    </div>

                </div>

                <button class="btn btn-primary" type="submit">Update</button>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

@endsection
