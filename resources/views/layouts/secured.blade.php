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
        <link rel="stylesheet" href="{{ asset('admin-panel/summernote/summernote-lite.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha256-nbyata2PJRjImhByQzik2ot6gSHSU4Cqdz5bNYL2zcU=" crossorigin="anonymous" />
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
                            <div class="col-md-11">
                                <h3>
                                    @yield('title')
                                </h3>
                            </div>

                            <div class="col-md-1">
                                @yield('button')
                            </div>
                        </div>

                        @yield('content')
                    </div>
                </main>
                <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © {{ \Carbon\Carbon::now()->format('Y') }} Developed by <a href="https://www.protus.by" target="_blank" title="Protus" rel="noopener noreferrer">Protus</a>. All rights reserved.</span></footer>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('admin-panel/vendor.js') }}"></script>
        <script src="{{ asset('admin-panel/bundle.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <script src="{{ asset('admin-panel/summernote/summernote-lite.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        @include('includes.secured.layout.scripts')

        @stack('scripts')
        <div id="c-preloader" style="position: absolute;top: 0;left: 0;background: RGBA(0, 0, 0, 0.5);z-index: 9999999999999999999999;width: 100%;height: 100%;display: none;"></div>
    </body>
</html>
