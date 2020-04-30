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
        <link rel="stylesheet" href="{{ asset('admin/admin.css') }}">
    </head>

    <body style="display: none">
        <div id='loader'>
            <div class="spinner"></div>
        </div>

        <div id="appRoot">
            <div class="sidebar">
                <div class="sidebar-inner">
                    @include('admin.layouts.includes.top-sidebar')
                    @include('admin.layouts.includes.sidebar')
                </div>
            </div>

            <div class="page-container">
                <div class="header navbar">
                    @include('admin.layouts.includes.header')
                </div>
                <main class="main-content bgc-grey-100">
                    <div id="mainContent">
                        <div class="row">
                            <div class="col-md-9">
                                <h4>
                                    @yield('title')
                                </h4>
                            </div>

                            <div class="col-md-3">
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
        <script src="{{ asset('admin/admin.js') }}"></script>
        @include('admin.layouts.includes.scripts')

        @stack('scripts')
    </body>
</html>
