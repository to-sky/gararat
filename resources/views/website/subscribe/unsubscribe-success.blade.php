@extends('website.layouts.master')

@section('title', __('Unsubscribe'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('unsubscribe') }}

        <div class="bg-white p-4 shadow-sm">
            <h5 class="mb-3 text-muted">{{ __('Thank you') }}</h5>

            <p>{{ __('You have been successfully removed from this subscriber list and won\'t receive any further emails from us.') }}</p>

            <p>
                <a href="{{ route('home') }}" class="btn btn-outline-danger">{{ __('Go Home') }}</a>
            </p>
        </div>
    </div>
@endsection