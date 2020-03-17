@extends('website.layouts.master')

@section('content')
    <div class="container">
        @if(App::isLocale('en'))
            <h1 class="page-title">{{ $pageTitle }}</h1>
        @else
            <h1 class="page-title text-right">{{ $pageTitle }}</h1>
        @endif
        @if(App::isLocale('en'))
            <div>
                {!! $page->pg_body !!}
            </div>
        @else
            <div class="text-right">
                {!! $page->pg_body_ar !!}
            </div>
        @endif
    </div>
    <!-- /.container -->
@endsection
