@extends('website.layouts.master')

@section('title') {{ __('Services') }} @endsection

@section('content')
    <div class="container">
        <h1 class="page-title">{{ __('Services') }}</h1>
        <div>
            {!!$page->trans('pg_body') !!}
        </div>
    </div>
@endsection