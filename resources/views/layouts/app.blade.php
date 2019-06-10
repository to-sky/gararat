<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title & Description -->
    <title>@if(isset($pageTitle) && NULL !== $pageTitle) {{ $pageTitle }} | Gararat @else Gararat @endif</title>
    @if(isset($pageDescription) && NULL !== $pageDescription)
        <meta name="description" content="{{ $pageDescription }}">
    @endif
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- OG -->
    <meta property="og:url" content="{{ \Request::url() }}">
    <meta property="og:site_name" content="{{ config('app.name', 'Gararat') }}">
    <meta property="og:title" content="@if(isset($pageTitle) && NULL !== $pageTitle) {{ $pageTitle }} | {{ config('app.name', 'Laravel') }} @else Gararat @endif">
    <meta property="og:description" content="@if(isset($pageDescription) && NULL !== $pageDescription) {{ $pageDescription }} @endif">
    <meta property="og:image" content="{{ asset('assets/logos/logo-og.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="1200">
    <!-- Site Verification -->
    <meta name="yandex-verification" content="" />
    <meta name="google-site-verification" content="" />
    <!-- Icons & Colors -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/logos/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/logos/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/logos/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="{{ asset('assets/logos/icons/safari-pinned-tab.svg') }}" color="#191a1c">
    <meta name="application-name" content="{{ config('app.name', 'Gararat') }}"/>
    <meta name="msapplication-TileColor" content="#191a1c">
    <meta name="theme-color" content="#191a1c">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141675953-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-141675953-1');
    </script>
</head>
    <body id="top">
        <header class="header">
            @include('includes.website.layout.header')
        </header>
        <!-- /.header -->
        <main class="main">
            @if(in_array(\Request::route()->getName(), ['catalogPage', 'figuresCatalogPage']))
                <div class="container mb-5">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            @include('includes.website.layout.sidebar')
                        </div>
                        <!-- /.col-12 col-lg-3 -->
                        <div class="col-12 col-lg-9">
                            <div class="breadcrumbs">
                                @if(isset($breadcrumbs) && $breadcrumbs !== NULL)
                                    <ul @if(!App::isLocale('en')) class="flex-row-reverse" @endif>
                                        @foreach($breadcrumbs as $breadcrumb)
                                            @if($breadcrumb['route'] !== NULL)
                                                <li><a href="{{ route($breadcrumb['route'], $breadcrumb['param']) }}">{{ $breadcrumb['name'] }}</a></li>
                                            @else
                                                <li><span>{{ $breadcrumb['name'] }}</span></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            @yield('content')
                        </div>
                        <!-- /.col-12 col-lg-9 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            @else
                <div class="container">
                    <div class="breadcrumbs">
                        @if(isset($breadcrumbs) && $breadcrumbs !== NULL)
                            <ul>
                                @foreach($breadcrumbs as $breadcrumb)
                                    @if($breadcrumb['route'] !== NULL)
                                        <li><a href="{{ route($breadcrumb['route'], $breadcrumb['param']) }}">{{ $breadcrumb['name'] }}</a></li>
                                    @else
                                        <li><span>{{ $breadcrumb['name'] }}</span></li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                @yield('content')
            @endif
        </main>
        <!-- /.main -->
        <footer class="footer">
            @include('includes.website.layout.footer')
        </footer>
        <!-- /.footer -->
        <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>
        <div class="cart-success">
            <span>Successfully Added to Cart</span>
        </div>
        <!-- /.cart-success -->
    </body>
</html>
