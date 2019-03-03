@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $pageTitle }}</h1>
        <div class="single-news">
            <div class="single-news__image">
                <p><i>Added: {{ \Carbon\Carbon::parse($news->nw_created)->format('Y-m-d') }}</i></p>
                <img src="{{ asset($news->nw_image) }}" alt="{{ $news->nw_name }}" class="image">
            </div>
            <!-- /.single-news__image -->
            <div class="single-news__body" style="margin: 30px 0;">
                {!! $news->nw_body !!}
            </div>
            <!-- /.single-news__body -->
        </div>
        <!-- /.single-news -->
    </div>
    <!-- /.container -->
@endsection
