@extends('website.layouts.master')

@section('title', optional($page)->trans('name'))

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ optional($page)->trans('name') }}</li>
        </ol>

        <h1 class="page-title">{{ optional($page)->trans('title') }}</h1>

        <div>
            {!! optional($page)->trans('body') !!}
        </div>
    </div>
@endsection