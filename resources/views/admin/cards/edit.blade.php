@extends('admin.masterAdmin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-fullheight">
            <div class="card-header">
                <h5 class="box-title">Update Card Section</h5>
            </div>

            <div class="card-body">

                @include('components.alert')

                {!! Form::open(['route' => ['cards.update', $card->id], 'method' => 'post']) !!}

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Title <span style="color:red">*</span></label>
                            <input class="form-control"
                                   type="text"
                                   name="title"
                                   value="{{ old('title', $card->title) }}"
                                   required>
                        </div>
                    </div>

                    {{-- HEAD 1 + BODY 1 --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Head 1 <span style="color:red">*</span></label>
                            <input class="form-control"
                                   type="text"
                                   name="head1"
                                   value="{{ old('head1', $card->head1) }}"
                                   required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Body 1 <span style="color:red">*</span></label>
                            <textarea class="form-control"
                                      name="body1"
                                      required>{{ old('body1', $card->body1) }}</textarea>
                        </div>
                    </div>

                    {{-- HEAD 2 + BODY 2 --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Head 2 <span style="color:red">*</span></label>
                            <input class="form-control"
                                   type="text"
                                   name="head2"
                                   value="{{ old('head2', $card->head2) }}"
                                   required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Body 2 <span style="color:red">*</span></label>
                            <textarea class="form-control"
                                      name="body2"
                                      required>{{ old('body2', $card->body2) }}</textarea>
                        </div>
                    </div>

                    {{-- HEAD 3 + BODY 3 --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Head 3 <span style="color:red">*</span></label>
                            <input class="form-control"
                                   type="text"
                                   name="head3"
                                   value="{{ old('head3', $card->head3) }}"
                                   required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Body 3 <span style="color:red">*</span></label>
                            <textarea class="form-control"
                                      name="body3"
                                      required>{{ old('body3', $card->body3) }}</textarea>
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
