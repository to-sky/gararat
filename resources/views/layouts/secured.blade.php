<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if($pageTitle && NULL !== $pageTitle) {{ $pageTitle }} @else {{ config('app.name', 'Laravel') }} @endif</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('admin-panel/style.css') }}">
</head>
    <body>

        <!-- Scripts -->
        <script src="{{ asset('admin-panel/vendor.js') }}"></script>
        <script src="{{ asset('admin-panel/bundle.js') }}"></script>
    </body>
</html>
