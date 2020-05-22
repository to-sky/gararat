@extends('website.layouts.master')

@section('title', optional($page)->trans('title'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('services') }}

        <h1 class="page-title">{{ optional($page)->trans('title') }}</h1>

        <div>
            {!! optional($page)->trans('body') !!}
        </div>
    </div>
@endsection