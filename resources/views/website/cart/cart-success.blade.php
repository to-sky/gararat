@extends('website.layouts.master')

@section('title') {{ __('Order created successfully') }} @endsection

@section('content')
    <div class="container mt-5" style="min-height: 400px;">
        <h1 class="page-title">{{ __('Order :id created successfully!', ['id' => $id]) }}</h1>
        <p>
            {{ __('Thank you for your order our specialists will reply you shortly! Please feel free to contact us for any enquiry.') }}
        </p>
        <p class="text-center">
            <a href="{{ route('home') }}">{{ __('Return to home page') }}</a>
        </p>
    </div>
@endsection
