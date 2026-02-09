@extends('layouts.admin')
@section('title','Home Page Visibility Settings')

@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Home Page Visibility Settings</h2>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @include('layouts.msg') <!-- For success/error messages -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Visibility</strong> Settings</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.visibility.settings') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @php
                                    $sections = [
                                        'home_hero' => 'Hero Section',
                                        'home_featured_services' => 'Featured Services',
                                        'home_cta' => 'Call To Action',
                                        'home_about' => 'About Section',
                                        'home_stats' => 'Stats Section',
                                        'home_services' => 'Services Section',
                                        'home_departments' => 'Departments Section',
                                        'home_doctors' => 'Doctors Section',
                                        'home_gallery' => 'Gallery Section',
                                        'home_testimony' => 'Testimonials Section',
                                        'home_partnerships' => 'Partnerships Section',
                                        'home_events' => 'Events Section',
                                        'home_news' => 'News Section',
                                        'home_head' => 'Home Head Section',
                                        'home_popup' => 'Popup Section',
                                        'home_mission' => 'Mission Section',
                                        'home_app' => 'App Section',
                                        'home_address' => 'Address Section',
                                        'home_directorates' => 'Directorates Section',
                                        'home_counters' => 'Counters Section',
                                    ];
                                @endphp

                                <div class="row">
                                    @foreach($sections as $key => $label)
                                    <div class="col-md-6 mb-3">
                                        <label class="switch">
                                            <input type="checkbox" name="{{ $key }}" {{ $visible->$key == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="ms-2">{{ $label }}</span>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Font Size Control -->
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="font_size">Font Size</label>
                                        <select name="font_size" class="form-control show-tick" id="font_size">
                                            <option value="16px" {{ $visible->font_size == '16px' ? 'selected' : '' }}>Default</option>
                                            <option value="18px" {{ $visible->font_size == '18px' ? 'selected' : '' }}>Medium</option>
                                            <option value="20px" {{ $visible->font_size == '20px' ? 'selected' : '' }}>Large</option>
                                        </select>
                                    </div>

                                    <!-- High Contrast Switch -->
                                    <div class="col-md-6">
                                        <label class="switch mt-4">
                                            <input type="checkbox" name="high_contrast" {{ $visible->high_contrast == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="ms-2">High Contrast Mode</span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-round mt-4">
                                    <i class="zmdi zmdi-check"></i> Save Visibility Settings
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
