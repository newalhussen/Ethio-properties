@extends('layouts.admin')
@section('title','Change Password')
@section('content')


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Change Password</h2>
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
<form method="POST" action="{{ route('admin.settings.change_password') }}">
    @csrf
    <div class="form-group form-float">
        <input type="password" class="form-control" placeholder="Old Password" id="InputCP" name="current-password" required>
    </div>
    <div class="form-group form-float">
        <input type="password" class="form-control" placeholder="New Password" id="InputNP" name="new-password" required>
    </div>
    <div class="form-group form-float">
        <input type="password" class="form-control" placeholder="Confirm Password" id="InputCNP" name="new-password_confirmation" required>
    </div>

    <button type="button" class="btn btn-success btn-circle btn-sm" onclick="togglePasswords()">
        <i class="zmdi zmdi-badge-check"></i> Show Passwords
    </button>

    <br><br><br>

    <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>
</form>

<script>
function togglePasswords() {
    const inputs = ['InputCP', 'InputNP', 'InputCNP'];
    inputs.forEach(id => {
        const input = document.getElementById(id);
        if(input.type === "password"){
            input.type = "text";
        } else {
            input.type = "password";
        }
    });
}
</script>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
@section('javascript')
<script type="text/javascript">
    function myFunction() {
        var InputCP = document.getElementById("InputCP");
        var InputNP = document.getElementById("InputNP");
        var InputCNP = document.getElementById("InputCNP");
        if (InputCP.type === "password") {
            InputCP.type = "text";
        } else {
            InputCP.type = "password";
        }

        if (InputNP.type === "password") {
            InputNP.type = "text";
        } else {
            InputNP.type = "password";
        }
        if (InputCNP.type === "password") {
            InputCNP.type = "text";
        } else {
            InputCNP.type = "password";
        }
    }
</script>
<!-- Jquery Core Js -->
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<!-- <script src="/Smart/Admin/assets/bundles/jvectormap.bundle.js"></script> -->
<script src="/Smart/Admin/assets/bundles/sparkline.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/c3.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/js/pages/index.js"></script>
@stop