@extends('website.layouts.master')

@section('title', __('Checkout'))

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endpush

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('checkout') }}

        <h1 class="page-title">{{ __('Checkout') }}</h1>

        <form action="{{ route('checkout.store') }}" method="post" class="needs-validation" novalidate>
            @csrf

            <div class="row">
                <div class="col-md-6 col-lg-7 col-xl-8 mb-4">
                    <div class="col-12 py-4 border border-light shadow-sm bg-white" data-mh="checkout">
                        @include('website.checkout._form-fields')
                    </div>
                </div>

                <div class="col-md-6  col-lg-5 col-xl-4">
                    <div class="col-12 border border-light shadow-sm bg-white" data-mh="checkout">
                        @include('website.checkout._cart-content')
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection