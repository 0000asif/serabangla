@extends('admin.masterAdmin')

@section('content')

<div class="card">
    <div class="card-header">
        <h5>Reviews List</h5>
        <a href="{{ route('reviews.create') }}" class="btn btn-primary btn-sm float-right">Add New</a>
    </div>

    <div class="card-body">

        @include('components.alert')

        <div class="table-responsive">
            <table class="table table-bordered w-100" id="dt-responsive">

                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Rating</th>
                        <th>Desc</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($reviews as $key => $review)
                    <tr>
                        <td>{{ $key + 1 }}</td>

                        <td>
                            <img src="{{ asset('reviews/' . $review->image) }}" width="60" class="img-thumbnail">
                        </td>

                        <td>{{ $review->name }}</td>
                        <td>{{ $review->city }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ Str::limit($review->desc, 50) }}</td>

                        <td>
                            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            {!! Form::open(['route' => ['reviews.destroy', $review->id], 'method' => 'delete', 'style'
                            => 'display:inline']) !!}
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                            {!! Form::close() !!}
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        {{ $reviews->links() }}

    </div>
</div>

@endsection