<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta content="@yield('description')" name="description">
    <meta content="@yield('keywords')" name="keywords">
    <meta name="author" content="@yield('author')">
    <meta property="og:image" content="@yield('image')">
    <meta name="thumbnail" content="@yield('image')">
    <meta name="twitter:image" content="@yield('image')">
    <link rel="icon" type="image/x-icon" href="{{ env('APP_URL') . '/uploads/Setting/' . $setting->favicon }}">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/Smart/Front/css/bootstrap.css">
    <link rel="stylesheet" href="/Smart/Front/css/style.css">
    <link rel="stylesheet" href="/Smart/Front/css/colors.css">
    <link rel="stylesheet" href="/Smart/Front/css/responsive.css">
    <link rel="stylesheet" href="/Smart/Front/css/css/style.css">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    @yield('css')
</head>

<body>
    <!-- pageWrapper -->
    <div id="pageWrapper">
        <!-- phStickyWrap -->
        <div class="phStickyWrap">
            <!-- pageHeader -->
            <header id="pageHeader" class="bg-white">
                <div class="hdTopBar py-2 py-xl-3 bg-dark d-md-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <ul class="list-unstyled hdScheduleList mb-0 d-flex flex-wrap align-items-center">
                                    <li>
                                        <a href="tel:{{ $setting->phone }}">
                                            <i class="fa-solid fa-phone-volume fa-shake"></i>
                                            {{ __('message.call_on') }}: {{ $setting->phone }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tel:{{ $setting->phone }}">
                                            <i class="fa-solid fa-envelope-open-text fa-beat-fade"></i>
                                            {{ __('message.email_at') }}: {{ $setting->emailInfo }}
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-4">
                                <ul class="list-unstyled hdAlterLinksList d-flex justify-content-end flex-wrap mb-0">

                                    <li>
                                        <a href="http://www.aacmp.gov.et/#/home/"
                                            target="_blank">{{ __('message.complaints') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.tenders') }}"> {{ __('message.tender') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hdFixerWrap py-2 py-md-3 py-xl-5 sSticky bg-white">
                    <div class="container">
                        <nav class="navbar navbar-expand-md navbar-light p-0">
                            <div class="logo flex-shrink-0 mr-3 mr-xl-8 mr-xlwd-16">
                                <a href="/">
                                    <img src="{{ asset('uploads/Setting/' . $setting->logo_transparent) }}"
                                        class="img-fluid" alt="egovt">
                                </a>
                            </div>
                            <div
                                class="hdNavWrap flex-grow-1 d-flex align-items-center justify-content-end justify-content-lg-start">
                                <div class="collapse navbar-collapse pageMainNavCollapse mt-2 mt-md-0"
                                    id="pageMainNavCollapse">
                                    <ul class="navbar-nav mainNavigation">
                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle"
                                                href="/">{{ __('message.home') }}</a>
                                        </li>
                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle"
                                                href="{{ route('front.departments') }}">{{ __('message.sectors') }}</a>
                                        </li>
                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle"
                                                href="{{ route('front.directorates') }}">{{ __('message.directorates') }}</a>
                                        </li>
                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle"
                                                href="{{ route('front.services') }}">{{ __('message.services') }}</a>
                                        </li>
                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle"
                                                href="{{ route('front.events') }}">{{ __('message.events') }}</a>
                                        </li>

                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle"
                                                href="{{ route('front.initiatives') }}">{{ __('message.stakeholders') }}</a>
                                        </li>
                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle"
                                                href="{{ route('front.blogs') }}">{{ __('message.news') }}</a>
                                        </li>
                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle"
                                                href="{{ route('front.contactus') }}">{{ __('message.contact') }}</a>
                                        </li>
                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle"
                                                href="{{ route('front.aboutus') }}">{{ __('message.about') }}</a>
                                        </li>
                                        <li class="nav-item dropdown ddohOpener">
                                            <a class="nav-link dropdown-toggle dropIcn" href="javascript:void(0);"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">{{ __('message.more') }}</a>
                                            <div class="dropdown-menu hdMainDropdown desktopDropOnHover">
                                                <ul class="list-unstyled mb-0 hdDropdownList">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('front.faqs') }}">{{ __('message.faq') }}</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('front.gallery') }}">{{ __('message.gallery') }}</a>
                                                    </li>
                                                     <li><a class="dropdown-item"
                                                            href="{{ route('front.publications') }}">{{ __('message.publications') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hdRighterWrap d-flex align-items-center justify-content-end">
                                <div class="dropdown hdLangDropdown ddohOpener d-lg-block">
                                    <a class="d-inline-block align-top dropdown-toggle dropIcn"
                                        href="javascript:void(0);" role="button" id="hdLanguagedropdown"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">{{ __('message.lang') }}</a>
                                    <div class="dropdown-menu dropdown-menu-right rounded-lg overflow-hidden desktopDropOnHover p-0"
                                        aria-labelledby="hdLanguagedropdown">
                                        <a class="dropdown-item text-center"
                                            href="{{ url('/localization/en') }}">{{ __('message.eng') }}</a>
                                        <a class="dropdown-item text-center"
                                            href="{{ url('/localization/am') }}">{{ __('message.am') }}</a>
                                        <a class="dropdown-item text-center"
                                            href="{{ url('/localization/or') }}">{{ __('message.or') }}</a>
                                    </div>
                                </div>

                                <button class="navbar-toggler pgNavOpener ml-2 bdrWidthAlter position-relative"
                                    type="button" data-toggle="collapse" data-target="#pageMainNavCollapse"
                                    aria-controls="pageMainNavCollapse" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                        </nav>
                    </div>
                </div>
            </header>
        </div>
        <main>
            @yield('content')
            @include('sweetalert::alert')

        </main>
        <!-- ftAreaWrap -->
        <div class="ftAreaWrap position-relative bg-gDark fontAlter" style="background-color: #1a538e !important;">
            <aside class="ftConnectAside pt-4 pb-3 pt-md-7 pb-md-7 text-center text-md-left">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-7">
                            <nav class="ftcaNav mb-4 mb-lg-0">
                                <ul
                                    class="list-unstyled d-flex flex-wrap mb-0 justify-content-center justify-content-lg-start text-white">
                                    <li>
                                        <a href="{{ route('front.blogs') }}">{{ __('message.news') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.departments') }}">{{ __('message.sectors') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.events') }}">{{ __('message.events') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('front.publications') }}">{{ __('message.publications') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.contactus') }}">{{ __('message.contact') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.gallery') }}">{{ __('message.gallery') }}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div
                                class="ctConnectWrap d-sm-flex justify-content-sm-center justify-content-lg-end align-items-sm-center text-white">
                                <strong
                                    class="title flex-shrink-0 mb-1 font-weight-normal mr-sm-3 d-block">{{ __('message.connect') }}</strong>
                                <ul
                                    class="list-unstyled socialNetworks ftSocialNetworks d-flex flex-wrap justify-content-center justify-content-sm-end mb-0">
                                    <li>
                                        <a href="{{ $setting->facebook }}" target="_blank">
                                            <i class="fab fa-facebook-square"><span
                                                    class="sr-only">{{ __('message.facebook') }}</span></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->twitter }}" target="_blank">
                                            <i class="fab fa-twitter"><span
                                                    class="sr-only">{{ __('message.twitter') }}</span></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->instagram }}" target="_blank">
                                            <i class="fab fa-instagram"><span
                                                    class="sr-only">{{ __('message.instagram') }}</span></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting->youtube }}" target="_blank">
                                            <i class="fab fa-youtube"><span
                                                    class="sr-only">{{ __('message.youtube') }}</span></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- footerAside -->
            <aside class="footerAside pt-9 pb-sm-2 pt-xl-14 pb-xl-12">
                <div class="container">
                    <div class="row text-white">
                        <div class="col-12 col-sm-6 col-md-5 col-xl-3 mb-6">
                            <div class="ftLogo mt-md-1 mb-6">
                                <a href="/">
                                    <img src="{{ asset('uploads/Setting/' . $setting->logo_footer) }}"
                                        class="img-fluid" alt="egovt">
                                </a>
                            </div>
                            <address class="mb-0 ftPlace">

                                <p class="mb-2"><strong class="font-weight-normal">
                                        @if (session()->get('lang_code') == 'en')
                                            {!! $setting->footer_note !!}
                                        @elseif(session()->get('lang_code') == 'am')
                                            {!! $setting->footer_note_am !!}
                                        @elseif(session()->get('lang_code') == 'or')
                                            {!! $setting->footer_note_or !!}
                                        @else
                                            {!! $setting->footer_note !!}
                                        @endif
                                    </strong></p>
                                <ul class="list-unstyled ftpScheduleList mb-0">
                                    <li>
                                        <i class="fas fa-phone-alt icn mr-1 mr-sm-0"><span
                                                class="sr-only">icon</span></i>
                                        <strong
                                            class="title font-weight-normal text-white">{{ __('message.phone') }}:</strong>
                                        <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-envelope icn mr-1 mr-sm-0"><span
                                                class="sr-only">icon</span></i>
                                        <strong
                                            class="title font-weight-normal text-white">{{ __('message.email') }}:</strong>
                                        <a href="mailto:{{ $setting->emailInfo }}">{{ $setting->emailInfo }}</a>
                                    </li>
                                </ul>
                            </address>
                        </div>
                        @php
                            $directorates = App\Models\Directorate::latest()
                                ->take(5)
                                ->get();
                        @endphp
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3 col-xlwd-2 mb-6">
                            <h3 class="ftHeading text-white mb-4">{{ __('message.directorates') }}</h3>
                            <ul class="list-unstyled ftsrLinksList mb-0">
                                @foreach ($directorates as $directorate)
                                    <li>
                                        <a
                                            href="{{ route('front.directorate.detail', $directorate->id) }}">{{ $directorate->getAmharicAcronymAttribute($directorate->name) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-12 col-sm-4 col-md-3 col-xl-2 col-xlwd-3 mb-6">
                            <div class="pl-xlwd-11">
                                <h3 class="ftHeading text-white mb-4">{{ __('message.useful') }}</h3>
                                <ul class="list-unstyled ftsrLinksList mb-0">
                                    <li>
                                        <a href="{{ route('front.blogs') }}">{{ __('message.our_blogs') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.contactus') }}">{{ __('message.gallery') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.aboutus') }}">{{ __('message.our_history') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.events') }}">{{ __('message.events') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.departments') }}">{{ __('message.sectors') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('front.directorates') }}">{{ __('message.directorates') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.faqs') }}">{{ __('message.faq') }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('front.publications') }}">{{ __('message.publications') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.privacy') }}">{{ __('message.privacy') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 col-md-12 col-xl-4 mb-6">
                            <div class="ml-xl-n1 ml-xlwd-n7">
                                <h3 class="ftHeading text-white mb-5">{{ __('message.news_and_update') }}</h3>
                                <form action="{{ route('contact.subscribe') }}" method="post"
                                    class="ftSubscribeForm">
                                    @csrf
                                    <label class="d-block mb-7">{{ __('message.news_and_update_desc') }}</label>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control form-control-lg" name="email"
                                            required placeholder="{{ __('message.enter_email') }}">
                                        <div class="input-group-append">
                                            <button type="submit"
                                                class="btn btnTheme d-flex font-weight-bold text-capitalize position-relative border-0 p-0"
                                                data-hover="{{ __('message.send') }}">
                                                <span class="d-block btnText">{{ __('message.subscribe') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- pageFooter -->
            <footer id="pageFooter" class="text-center bg-dark pt-6 pb-3 pt-md-8 pb-md-5 text-white">
                <div class="container">
                    <p><a href="javascript:void(0);">{{ $setting->siteTitle }}</a> - &copy; {{ date('Y') }}. <br
                            class="d-md-none">{{ __('message.all') }} - Powered by<a href="https://aaitdb.gov.et/"
                            target="_blank"> ITDB</a></p>
                </div>
            </footer>
        </div>
    </div>
    <!-- include jQuery library -->
    <script src="/Smart/Front/js/jquery-3.4.1.min.js"></script>
    <script src="/Smart/Front/js/jqueryCustom.js"></script>
    <script src="/Smart/Front/js/plugins.js"></script>
    <!-- <script src="../../../../kit.fontawesome.com/391f644c42.js"></script> -->
    <script>
        // script.js
        if (window.innerWidth > 768) {
            document.addEventListener('DOMContentLoaded', function() {
                const popup = document.getElementById('popup');
                const closePopup = document.getElementById('close-popup');

                // Function to show the popup
                function showPopup() {
                    popup.style.display = 'block';
                }

                // Function to close the popup
                function closePopupFunc() {
                    popup.style.display = 'none';
                }

                // Automatically show the popup after a delay (e.g., 5 seconds)
                setTimeout(showPopup, 5000);

                // Close the popup when the close button is clicked
                closePopup.addEventListener('click', closePopupFunc);
            });
        }
    </script>
    @yield('script')
</body>

</html>
