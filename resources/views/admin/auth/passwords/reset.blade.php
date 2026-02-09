@extends('layouts.user')
@section('title', 'ITDB | Auth')
@section('description', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009. ')
@section('view', 'Addis Ababa City Innovation and Technology Development Bureau (ITDB) is a government organization that was originally constituted as an agency in April 2009 GC under proclamation No. 11/2009. ')
@section('keywords', '')
@section('image', 'https://allpurposeadventures.net/AllPurpose/User/assets/img/logo.png')
@section('content')

<section class="login_section py-8 py-md-15 py-xl-22 fontAlter">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-xl-4">
                <ul class="nav nav-tabs tabset justify-content-center mb-10" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link tablink active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Reset Password</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link tablink" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                    </li> -->
                </ul>
                <div class="tab-content" id="loginTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        @include('layouts.msg')
                        <form action="{{ route('password.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">New Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="email" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btnTheme fwMedium w-100 d-block text-capitalize position-relative border-0 p-0" data-hover="Reset Password">
                                <span class="d-block btnText">Reset Password</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('script')

@stop

@endsection('section')