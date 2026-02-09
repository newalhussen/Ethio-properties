@extends('layouts.user')

@section('title', $setting->siteTitle .' | Home Page')
@section('description', $setting->sitedescription)
@section('view', $setting->sitedescription)
@section('author', $setting->siteTitle)
@section('keywords', $setting->keywords)
@section('image', env('APP_URL') . '/uploads/Setting/' . $setting->logo_white)

@section('css')
<style>
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 999;
        animation: fadeIn 0.5s ease-in-out;
    }

    .popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        text-align: center;
        animation: slideIn 0.5s ease-in-out;
    }

    .language-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .language-button {
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .language-button:hover {
        background-color: #2980b9;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    /* Media Query for Mobile Views */
    @media (max-width: 768px) {
        .popup-content {
            display: none;
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from { transform: translate(-50%, -60%); }
        to { transform: translate(-50%, -50%); }
    }
</style>
@stop

@section('content')
@if(is_null(session()->get("lang_code")))
<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close" id="close-popup">&times;</span>
        <h2>Choose Language</h2>
        <div class="language-buttons">
            <button class="language-button" onclick="window.location.href='{{ url('/localization/en') }}'">English</button>
            <button class="language-button" onclick="window.location.href='{{ url('/localization/am') }}'">አማርኛ</button>
        </div>
    </div>
</div>
@endif
<!-- banners -->
@include('layouts.user.home._banner')

<!-- head message -->
@if($visible->home_head == '1')
@include('layouts.user.home._head_message')
@endif

<!-- sectors -->
@if($visible->home_departments == '1')
@include('layouts.user.home._departments')
@endif

<!-- directorates -->
@if($visible->home_directorates == '1')
@include('layouts.user.home._directorates')
@endif


<!-- counters -->
@if($visible->home_counters == '1')
@include('layouts.user.home._counter')
@endif
<!-- events -->
@if($visible->home_events == '1')
@include('layouts.user.home._events')
@endif
<!-- news -->
@if($visible->home_news == '1')
@include('layouts.user.home._news')
@endif

<!-- services -->
@if($visible->home_services == '1')
@include('layouts.user.home._explore_services')
@endif


@if($visible->home_gallery == '1')
@include('layouts.user.home._gallery_highlights')
@endif
@if($visible->home_mission == '1')
@include('layouts.user.home._miss')
@endif
@if($visible->home_app == '1')
@include('layouts.user.home._app')
@endif
@if($visible->home_testimony == '1')
@include('layouts.user.home._testimony')
@endif
@if($visible->home_address == '1')
@include('layouts.user.home._location')
@endif

@section('script')

@stop

@endsection('section')