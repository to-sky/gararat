@extends('website.layouts.master')

@section('title', $post->trans('title'))
@section('og-title', $post->trans('title'))
@section('og-description', $post->trans('short_description'))
@section('og-image', asset($post->getFirstMediaUrl("thumbnail", 'medium')))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('post', $post) }}

        <h1 class="page-title">{{ $post->trans('title') }}</h1>

        <div class="single-post">
            <div class="text-muted">
                <p class="text-sm"><i class="far fa-clock"></i> {{ $post->created_at->calendar() }}</p>
            </div>

            <div class="single-post__body">{!! $post->trans('body') !!}</div>
        </div>
    </div>
@endsection
