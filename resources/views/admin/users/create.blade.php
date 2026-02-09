@extends('layouts.admin')
@section('title','Add New User')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@stop
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add New User</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-icon float-right">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @include('layouts.msg') <!-- Success/Error messages -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>User</strong> Information</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.users.store') }}" method="POST">
                                @csrf

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone">Phone</label>
                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password">Password</label>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
<div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role" class="form-control" required>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>
</div>

                                </div>

                                <button type="submit" class="btn btn-primary btn-round">
                                    <i class="zmdi zmdi-check"></i> Save User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('javascript')
<script src="/Smart/Admin/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
@stop
@endsection
