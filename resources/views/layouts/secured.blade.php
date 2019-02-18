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
    <link rel="stylesheet" href="{{ asset('admin-panel/summernote/summernote-lite.css') }}">
</head>
    <body class="app">
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
                        @yield('content')
                    </div>
                </main>
                <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © {{ \Carbon\Carbon::now()->format('Y') }} Developed by <a href="https://www.protus.by" target="_blank" title="Protus" rel="noopener noreferrer">Protus</a>. All rights reserved.</span></footer>
            </div>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('admin-panel/vendor.js') }}"></script>
        <script src="{{ asset('admin-panel/bundle.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="{{ asset('admin-panel/summernote/summernote-lite.min.js') }}"></script>
        <script>
            (function($) {
                $('.summernote').summernote({
                    height: 300,
                    toolbar: [
                        // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['para', ['ul', 'ol', 'paragraph']]
                    ],
                    callbacks: {
                        onPaste: function (e) {
                            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                            e.preventDefault();
                            // Firefox fix
                            setTimeout(function () {
                                document.execCommand('insertText', false, bufferText);
                            }, 10);
                        }
                    }
                });
            })(jQuery);
        </script>
    </body>
</html>
