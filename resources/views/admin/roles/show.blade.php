@extends('layouts.admin')
@section('title','Roles')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Roles</h2>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-plus"></i>
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
            <div class="body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                            <label class="label label-success badge badge-success ">{{ $v->name }}</label>
                            @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @section('javascript')
            <script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
            <script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
            <script src="/Smart/Admin/assets/bundles/datatablescripts.bundle.js"></script>
            <script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
            <script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
            <script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
            <script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
            <script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
            <script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
            <script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>
            <script src="/Smart/Admin/assets/js/pages/tables/jquery-datatable.js"></script>

            @stop
            @endsection