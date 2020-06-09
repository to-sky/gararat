@extends('website.layouts.master')

@section('title', __('Subscribe'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('subscribe') }}

        <div class="bg-white p-4 shadow-sm">
            <h5 class="mb-3 text-muted">{{ __('Thank you') }}</h5>
            <p class="text-muted">{{ __('You\'ve just been sent an email to confirm your email address.') }}</p>
            <p class="mb-4 text-muted">{{ __('Please click on the button in this email to confirm your subscription.') }}</p>

            <p>
                <a href="{{ route('home') }}" class="btn btn-outline-danger">{{ __('Go Home') }}</a>
            </p>
        </div>
    </div>
@endsection