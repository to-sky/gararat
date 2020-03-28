@extends('website.layouts.master')

@section('title') {{ $news->trans('nw_title') }} @endsection

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $news->trans('nw_title') }}</h1>

        <div class="single-news">
            <div class="single-news__image">
                <p><i class="far fa-clock"></i> {{ $news->nw_created_at }}</p>
                <img src="{{ asset($news->nw_image) }}" alt="{{ $news->nw_name }}" class="image">
            </div>

            <div class="single-news__body my-5">
                <div>{!! $news->trans('nw_body') !!}</div>
            </div>
        </div>
    </div>
@endsection