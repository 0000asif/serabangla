@extends('admin.masterAdmin')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Gift List</h5>

                    <div>
                        <a href="{{ route('gift.import.view') }}" class="btn btn-success">
                            <i class="fa fa-upload"></i> Import Gifts
                        </a>

                    </div>
                </div>

                <div class="card-body">

                    @include('components.alert')

                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="dt-responsive">

                            <thead>
                                <tr>
                                    <th width="80">SL</th>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Created</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($gifts as $key => $gift)

                                    <tr>

                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $gift->name }}</td>
                                        <td>
                                            {{ '#' . strtoupper(substr(md5($gift->id . $gift->created_at . Str::random(10)), 0, 10)) }}
                                        </td>

                                        <td>{{ $gift->created_at->format('d M Y') }}</td>



                                    </tr>

                                @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection