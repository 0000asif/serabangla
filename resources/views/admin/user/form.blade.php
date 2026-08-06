@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Add User</h5>
                    </div>
                    <div class="card-body">
                        @include('components.alert')
                        {!! Form::open(['method' => 'post', 'route' => 'user.store', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6 mb-4"> <label>Full Name *</label> <input type="text" name="name"
                                    class="form-control" required> </div>
                            <div class="col-md-6 mb-4"> <label>Email *</label> <input type="email" name="email"
                                    class="form-control" required> </div>
                            <div class="col-md-6 mb-4"> <label>Phone *</label> <input type="text" name="phone"
                                    class="form-control" required> </div>
                            <div class="col-md-6 mb-4"> <label>Password *</label> <input type="password" name="password"
                                    class="form-control" required> </div>
                            <div class="col-md-6 mb-4"> <label>Confirm Password *</label> <input type="password"
                                    name="password_confirmation" class="form-control" required> </div>
                            <div class="col-md-6 mb-4"> <label>Role</label> <select name="role" class="form-control">
                                    <option value="agent">Agent</option>
                                    <option value="admin">Admin</option>
                                </select> </div>
                            <div class="col-md-6 mb-4"> <label>Profile Image</label> <input type="file"
                                    name="profile_photo_path" class="form-control"> </div>
                            <div class="col-md-12 mb-4"> <label>Address</label>
                                <textarea name="address" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 mb-4"> <label>Status</label> <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select> </div>
                        </div> <button type="submit" class="btn btn-primary"> Create User </button>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
