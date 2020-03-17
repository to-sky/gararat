@extends('website.layouts.master')

@section('content')
    <div class="container">
        @if(App::isLocale('en'))
            <h1 class="page-title">{{ $pageTitle }}</h1>
        @else
            <h1 class="page-title text-right">{{ $pageTitle }}</h1>
        @endif
        <div class="single-news">
            <div class="single-news__image">
                @if(App::isLocale('en'))
                    <p><i>Added: {{ \Carbon\Carbon::parse($news->nw_created)->format('Y-m-d') }}</i></p>
                @else
                    <p class="text-right"><i><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($news->nw_created)->format('Y-m-d') }}</i></p>
                @endif
                <img src="{{ asset($news->nw_image) }}" alt="{{ $news->nw_name }}" class="image">
            </div>
            <!-- /.single-news__image -->
            <div class="single-news__body" style="margin: 30px 0;">
                @if(App::isLocale('en'))
                    <div>
                        {!! $news->nw_body !!}
                    </div>
                @else
                    <div class="text-right">
                        {!! $news->nw_body_ar !!}
                    </div>
                @endif
            </div>
            <!-- /.single-news__body -->
        </div>
        <!-- /.single-news -->
    </div>
    <!-- /.container -->
@endsection
