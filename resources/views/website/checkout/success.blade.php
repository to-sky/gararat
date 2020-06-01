@extends('website.layouts.master')

@section('title', __('Order created successfully'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('order-created') }}

        <div class="bg-white p-4 shadow-sm">
            <h5 class="mb-3 text-muted">{{ __('Order №:id created successfully!', ['id' => $order->id]) }}</h5>

            <p class="mb-4">{{ __('Thank you for your order our specialists will reply you shortly! Please feel free to contact us for any enquiry.') }}</p>

            <a href="{{ route('home') }}" class="btn btn-outline-secondary">{{ __('Go to Home') }}</a>
        </div>
    </div>
@endsection
