@extends('website.layouts.master')

@section('title', optional($page)->trans('name'))

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ optional($page)->trans('name') }}</li>
        </ol>

        <h1 class="page-title">{{ optional($page)->trans('title') }}</h1>

        <div class="page-content">
            {!! optional($page)->trans('body') !!}

            {{-- Only for Financing page --}}
            @if (request()->is('financing'))
                @include('website.includes._apply-funding-form')
            @endif
        </div>
    </div>
@endsection
