@extends('layouts.admin')
@section('title','Create Role')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@stop
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Create Role</h2>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @include('layouts.msg')

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{ route('admin.roles.store') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <!-- Role Name -->
                                    <div class="col-md-6">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    </div>

                                    <!-- Permissions -->
                                    <div class="col-md-6">
                                        <label for="permission">Assign Permissions</label>
                                        <select name="permission[]" id="permission" class="form-control show-tick" multiple required>
                                            @foreach($permissions as $perm)
                                                <option value="{{ $perm->id }}">
                                                    {{ ucfirst($perm->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12 mt-4 text-center">
                                        <button type="submit" class="btn btn-primary btn-round">
                                            <i class="zmdi zmdi-check"></i> Create Role
                                        </button>
                                    </div>

                                </div> <!-- row -->
                            </form>
                        </div> <!-- body -->
                    </div> <!-- card -->
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- body_scroll -->
</section>

@section('javascript')
<script src="/Smart/Admin/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
@stop
@endsection
