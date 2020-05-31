@extends('website.layouts.master')

@section('title', __('News'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('news') }}

        <h1 class="page-title">{{ __('News') }}</h1>

        <div class="row">
            @foreach($news as $item)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    @include('website.includes._news-item')
                </div>
            @endforeach
        </div>
    </div>
@endsection