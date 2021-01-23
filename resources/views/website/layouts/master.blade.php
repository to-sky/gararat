<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title & Description -->
    <title>@yield('title') | {{ config('app.name', 'Gararat') }}</title>
    <meta name="description" content="@yield('description')">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- OG -->
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="{{ config('app.name', 'Gararat') }}">
    <meta property="og:title" content="@yield('og-title') | {{ config('app.name', 'Gararat') }}">
    <meta property="og:description" content="@yield('og-description')">
    <meta property="og:image" content="@yield('og-image', asset('images/header_logo.png'))">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="1200">

    <!-- Site Verification -->
    <meta name="yandex-verification" content="" />
    <meta name="google-site-verification" content="" />

    <!-- Icons & Colors -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/favicon-180.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32.png') }}">

    <link rel="manifest" href="/site.webmanifest">
    <meta name="application-name" content="{{ config('app.name', 'Gararat') }}"/>
    <meta name="msapplication-TileColor" content="#191a1c">
    <meta name="theme-color" content="#191a1c">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141675953-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-141675953-1');
    </script>
</head>

<body id="app" @if(! isLocaleEn()) class="rtl" @endif>
<header>
    @include('website.layouts.includes.header')
</header>

<main>
    @yield('content')
</main>

<footer>
    @include('website.layouts.includes.footer')
</footer>

{{-- Cart added product --}}
<div class="cart-success">
    <span>{{ __('Successfully added to cart') }}</span>
</div>

{{-- Alert message popup --}}
@include('website.includes._alert-popup')

{{-- Popup container for search form --}}
<div class="search-popup"></div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')

<script>
    // Search popup
    $('.header-main__search-icon').click(function() {
        $.confirm({
            title: '{{ __("Search") }}',
            theme: 'supervan',
            content: '' +
                '<form action="{{ route('search') }}" class="search-form needs-validation" novalidate>' +
                '<div class="form-group">' +
                '<input type="text" placeholder="{{ __('Enter product name or producer id') }}" name="q" class="search-form__input-name form-control" value="{{ request('q') }}" required />' +
                '<div class="invalid-feedback">' +
                '{{ __('Search field must be filled.') }}' +
                '</div>' +
                '</div>' +
                '</form>',
            escapeKey: 'close',
            rtl: '{{ ! isLocaleEn() }}',
            container: '.search-popup',
            closeIcon: true,
            draggable: false,
            columnClass: 'col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3 ',
            backgroundDismiss: false,
            backgroundDismissAnimation: 'random',
            buttons: {
                search: {
                    text: '{{ __("Search") }}',
                    btnClass: 'search-form__btn-search',
                    action: function() {
                        let searchForm = $('.search-form');
                        searchForm.addClass('was-validated');

                        if (! $('.search-form__input-name').val()) {
                            return false;
                        }

                        searchForm.submit();
                    }
                },
                close: {
                    text: '{{ __('Close') }}',
                    btnClass: 'search-form__btn-close',
                    action: function () {
                        // action need to work esc key for close popup
                    }
                }
            },
            onOpen: function() {
                $('.search-form__input-name').focus();
            }
        });
    });
</script>
</body>
</html>
