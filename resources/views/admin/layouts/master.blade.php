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
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.tiny.cloud/1/dx8b0exnz6aupmx3uci3tmye1ul50zf7m36rot1eukca7c00/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
                <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                    <span>Copyright &copy; {{ \Carbon\Carbon::now()->format('Y') }} Developed by <a href="https://t.me/tolsky" title="Tolsky Dmitry" rel="noopener noreferrer">Tolsky Dmitry</a>. All rights reserved.</span>
                </footer>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/admin.js') }}"></script>
        @include('admin.layouts.includes.scripts')

        @stack('scripts')
    </body>
</html>
