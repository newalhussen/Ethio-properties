@extends('layouts.admin')
@section('title','Profile')
@section('content')


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Profile</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            @include('layouts.msg')
                            <form method="post" action="{{ route('admin.change.profile') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" placeholder="Name" name="name" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" value="{{ Auth::user()->email }}" placeholder="Email" name="email" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" value="{{ Auth::user()->phone }}" placeholder="Phone" name="phone" required>
                                </div>
                                <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()" type="submit">Change</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
@section('javascript')
<!-- Jquery Core Js -->
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<!-- <script src="/Smart/Admin/assets/bundles/jvectormap.bundle.js"></script> -->
<script src="/Smart/Admin/assets/bundles/sparkline.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/c3.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/js/pages/index.js"></script>
@stop