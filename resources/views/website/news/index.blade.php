@extends('website.layouts.master')

@section('title', __('News'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('news') }}

        <h1 class="page-title">{{ __('News') }}</h1>

        <div class="row">
            @foreach($news as $item)
                @include('website.includes._news-item')
            @endforeach
        </div>
    </div>
@endsection