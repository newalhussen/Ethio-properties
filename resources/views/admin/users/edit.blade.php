@extends('layouts.admin')
@section('title','Edit User')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/dropify/css/dropify.min.css">
@stop
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit User</h2>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @include('layouts.msg') <!-- Success/Error messages -->

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-6 mt-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 mt-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6 mt-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}">
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6 mt-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                                    </div>

<!-- Role -->
<div class="col-md-6 mt-3">
    <label for="role">Role</label>
    <select name="role" id="role" class="form-control show-tick" required>
        <option value="">Select Role</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
</div>

                                    <!-- Submit -->
                                    <div class="col-12 mt-4 text-center">
                                        <button type="submit" class="btn btn-primary btn-round">
                                            <i class="zmdi zmdi-check"></i> Update User
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- body -->
                    </div> <!-- card -->
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- body_scroll -->
</section>

@section('javascript')
<script src="/Smart/Admin/assets/plugins/dropify/js/dropify.min.js"></script>
<script>
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>
@stop
@endsection
