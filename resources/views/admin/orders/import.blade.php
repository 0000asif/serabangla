@extends('admin.masterAdmin')

@section('content')
<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-fullheight">

                <div class="card-header">
                    <h5 class="box-title">Import Gifts</h5>
                </div>

                <div class="card-body">

                    @include('components.alert')

                    {!! Form::open([
                        'method' => 'post',
                        'route' => 'gift.import',
                        'files' => true
                    ]) !!}

                    <div class="row">

                        <div class="col-md-12 mb-4">
                            <label>Select CSV/Excel File <span class="text-danger">*</span></label>
                            <input type="file"
                                   name="file"
                                   class="form-control"
                                   accept=".csv,.xlsx,.xls"
                                   required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <p class="text-muted">
                                Supported formats: <strong>.csv</strong>,
                                <strong>.xlsx</strong>,
                                <strong>.xls</strong>
                            </p>

                            <p class="mb-0">
                                Expected columns:
                                <code>name</code>,
                                <code>value</code>
                            </p>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-upload"></i> Import Gifts
                    </button>

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>
</div>
@endsection