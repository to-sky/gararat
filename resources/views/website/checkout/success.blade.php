@extends('website.layouts.master')

@section('title', __('Order created successfully'))

@section('content')
    <div class="container mt-5" style="min-height: 400px;">
        <h1 class="page-title">{{ __('Order №:id created successfully!', ['id' => $order->id]) }}</h1>
        <p class="mb-5">
            {{ __('Thank you for your order our specialists will reply you shortly! Please feel free to contact us for any enquiry.') }}
        </p>

        <a href="{{ route('home') }}" class="btn btn-outline-secondary">{{ __('Go to Home') }}</a>
    </div>
@endsection
