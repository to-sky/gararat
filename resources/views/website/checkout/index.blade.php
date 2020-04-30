@extends('website.layouts.master')

@section('title', __('Checkout'))

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endpush

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('checkout') }}

        <h1 class="page-title">{{ __('Checkout') }}</h1>

        <div class="row">

            <div class="col-md-12">
                <form action="{{ route('checkout.store') }}" method="post" class="needs-validation mb-4" novalidate>
                    @csrf

                    <div class="row">
                        <div class="col-8">
                            <div class="col-12 py-4 border border-light shadow-sm bg-white">
                                @include('website.checkout._form-fields')
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="col-12 border border-light shadow-sm bg-white">
                                @include('website.checkout._cart-content')
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection