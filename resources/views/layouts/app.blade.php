<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title & Description -->
    <title>@if(isset($pageTitle) && NULL !== $pageTitle) {{ $pageTitle }} | {{ config('app.name', 'Laravel') }} @else Gararat @endif</title>
    @if(isset($pageDescription) && NULL !== $pageDescription)
        <meta name="description" content="{{ $pageDescription }}">
    @endif
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- Styles -->
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
</head>
<body>

</body>
</html>
