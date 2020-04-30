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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" integrity="sha256-PHcOkPmOshsMBC+vtJdVr5Mwb7r0LkSVJPlPrp/IMpU=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <!-- OG -->
        <meta property="og:url" content="{{ request()->url() }}">
        <meta property="og:site_name" content="{{ config('app.name', 'Gararat') }}">
        <meta property="og:title" content="@yield('title') | {{ config('app.name', 'Gararat') }}">
        <meta property="og:description" content="@yield('description')">
        <meta property="og:image" content="{{ asset('images/logo.png') }}">
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

    <body id="top" @if(! isLocaleEn()) class="rtl" @endif>
        <header class="header position-relative">
            @include('website.layouts.includes.header')
        </header>

        <main class="main">
            @yield('content')
        </main>

        <footer class="footer">
            @include('website.layouts.includes.footer')
        </footer>

        <div class="cart-success">
            <span>{{ __('Successfully added to cart') }}</span>
        </div>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>