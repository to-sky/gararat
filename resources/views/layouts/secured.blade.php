{{-- Admin main layout --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} - @yield('title', auth()->user()->name)</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('admin-panel/admin.css') }}">
    </head>

    <body class="app" style="display: none">
        <div id='loader'>
            <div class="spinner"></div>
        </div>

        {{-- TODO: remove after debug title --}}
        @if(isset($pageTitle))
            <h1 class="text-danger pos-a z-2">pageTitle isset!</h1>
        @endif

        <div id="appRoot">
            <div class="sidebar">
                <div class="sidebar-inner">
                    @include('includes.secured.layout.top-sidebar')
                    @include('includes.secured.layout.sidebar')
                </div>
            </div>

            <div class="page-container">
                <div class="header navbar">
                    @include('includes.secured.layout.header')
                </div>
                <main class="main-content bgc-grey-100">
                    <div id="mainContent">
                        <div class="row">
                            <div class="col-md-10">
                                <h3>
                                    @yield('title')
                                </h3>
                            </div>

                            <div class="col-md-2">
                                @yield('button')
                            </div>
                        </div>

                        @yield('content')
                    </div>
                </main>
                <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © {{ \Carbon\Carbon::now()->format('Y') }} Developed by <a href="https://www.protus.by" target="_blank" title="Protus" rel="noopener noreferrer">Protus</a>. All rights reserved.</span></footer>
            </div>
        </div>
        <div id="c-preloader" style="position: absolute;top: 0;left: 0;background: RGBA(0, 0, 0, 0.5);z-index: 9999999999999999999999;width: 100%;height: 100%;display: none;"></div>

        <!-- Scripts -->
        <script src="{{ asset('admin-panel/admin.js') }}"></script>
        @include('includes.secured.layout.scripts')

        @stack('scripts')
    </body>
</html>
