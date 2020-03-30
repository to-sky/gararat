@extends('website.layouts.master')

@section('title') {{ __('Services') }} @endsection

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('services') }}

        <h1 class="page-title">{{ __('Services') }}</h1>

        <div>
            {!!$page->trans('pg_body') !!}
        </div>
    </div>
@endsection