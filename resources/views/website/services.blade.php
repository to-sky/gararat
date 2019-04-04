@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $pageTitle }}</h1>
        @if(App::isLocale('en'))
            {!! $page->pg_body !!}
        @else
            {!! $page->pg_body_ar !!}
        @endif
    </div>
    <!-- /.container -->
@endsection
