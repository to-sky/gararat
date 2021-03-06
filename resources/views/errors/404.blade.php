@extends('website.layouts.master')

@section('title', __('Page Not Found'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('404') }}

        <h1 class="title-404">404</h1>

        <h2 class="text-center text-muted mb-5">{{ __('Sorry, the page you are looking for could not be found.') }}</h2>

        <div class="text-center">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">{{ __('Go Home') }}</a>
        </div>
    </div>
@endsection
