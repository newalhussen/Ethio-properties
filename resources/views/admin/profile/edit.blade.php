@extends('layouts.admin')
@section('title', 'Edit Profile')

@section('content')
<section class="content">
    <div class="body_scroll">

        {{-- Header --}}
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Profile</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Success Message --}}
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Profile Card --}}
            <div class="card">
                <div class="header">
                    <h2>Your Information</h2>
                </div>
                <div class="body">

                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf

                        {{-- Name --}}
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="form-control"
                                   placeholder="Enter your name">

                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="form-control"
                                   placeholder="Enter your email">

                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="form-group">
                            <label for="phone" class="font-weight-bold">Phone</label>
                            <input type="text"
                                   name="phone"
                                   value="{{ old('phone', $user->phone) }}"
                                   class="form-control"
                                   placeholder="Enter phone number">

                            @error('phone')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn btn-primary btn-round">
                            Update Profile
                        </button>

                    </form>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection
