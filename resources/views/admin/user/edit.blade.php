@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Add User</h5>
                    </div>
                    <div class="card-body"> @include('components.alert')
                        {!! Form::model($user, ['method' => 'PUT', 'route' => ['user.update', $user->id], 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6 mb-4"> <label>Name *</label> <input type="text" name="name"
                                    class="form-control" value="{{ $user->name }}" required> </div>
                            <div class="col-md-6 mb-4"> <label>Email *</label> <input type="email" name="email"
                                    class="form-control" value="{{ $user->email }}" required> </div>
                            <div class="col-md-6 mb-4"> <label>Phone</label> <input type="text" name="phone"
                                    class="form-control" value="{{ $user->phone }}"> </div>
                            <div class="col-md-6 mb-4"> <label>Status</label> <select name="status" class="form-control">
                                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}> Active
                                    </option>
                                    <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}> Inactive
                                    </option>
                                </select> </div>
                            <div class="col-md-12 mb-4"> <label>Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ $user->address }}</textarea>
                            </div>
                            <div class="col-md-6 mb-4"> <label>New Password</label> <input type="password" name="password"
                                    class="form-control"> <small class="text-muted"> Leave blank if you don't want to change
                                    password. </small> </div>
                            <div class="col-md-6 mb-4"> <label>Confirm Password</label> <input type="password"
                                    name="password_confirmation" class="form-control"> </div>
                            <div class="col-md-6 mb-4"> <label>Profile Image</label>
                                <input type="file" name="profile_photo_path" class="form-control">
                                @if ($user->profile_photo_path)
                                    <div class="mb-2"> <img
                                            src="{{ asset('uploads/users/' . $user->profile_photo_path) }}" width="100">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-4">
                                <label>Role</label>
                                <select name="role" class="form-control">
                                    <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="agent" {{ $user->type == 'agent' ? 'selected' : '' }}>Agent</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"> Update User </button> {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
