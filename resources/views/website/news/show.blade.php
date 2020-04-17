@extends('website.layouts.master')

@section('title', $news->trans('title'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('news.show', $news) }}

        <h1 class="page-title">{{ $news->trans('title') }}</h1>

        <div class="single-news">
            <div class="text-muted">
                <p class="text-sm"><i class="far fa-clock"></i> {{ $news->created_at->calendar() }}</p>
            </div>

            <div class="slider-pro" id="newsSlider">
                <div class="sp-slides">
                    @if($images = $news->getMedia('news_images'))
                        @foreach($images as $image)
                            <div class="sp-slide">
                                <img src="{{ asset($image->getUrl()) }}" alt="{{ $image->name }}" class="image">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="single-news__body">{!! $news->trans('body') !!}</div>
        </div>
    </div>
@endsection