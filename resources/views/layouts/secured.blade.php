<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if($pageTitle && NULL !== $pageTitle) {{ $pageTitle }} @else {{ config('app.name', 'Laravel') }} @endif</title>
</head>
<body>

</body>
</html>
