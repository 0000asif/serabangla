@extends('admin.masterAdmin')

@section('content')
    <div class="row">
        <div class="col-lg-12">


            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User List</h5>

                    <a href="{{ route('user.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add User
                    </a>
                </div>

                <div class="card-body">

                    @include('components.alert')


                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="dt-responsive">

                            <thead>
                                <tr>
                                    <th width="80">Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($users as $user)
                                    <tr>

                                        <td>
                                            @if ($user->profile_photo_path)
                                                <img src="{{ asset('uploads/users/' . $user->profile_photo_path) }}"
                                                    width="50" height="50"
                                                    style="object-fit:cover;border-radius:50%;">
                                            @else
                                                <img src="{{ asset('image/user.png') }}" width="50" height="50"
                                                    style="object-fit:cover;border-radius:50%;">
                                            @endif
                                        </td>

                                        <td>{{ $user->name }}</td>

                                        <td>{{ $user->email }}</td>

                                        <td>{{ $user->phone }}</td>

                                        <td>
                                            @if ($user->status == 'active')
                                                <span class="badge bg-success">
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $user->created_at->format('d M Y') }}
                                        </td>

                                        <td>

                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            {{-- <form
                                        action="{{ route('user.destroy',$user->id) }}"
                                        method="POST"
                                        style="display:inline-block">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </form> --}}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No Users Found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>

        </div>


    </div>
@endsection
