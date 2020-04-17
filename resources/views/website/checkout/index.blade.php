@extends('website.layouts.master')

@section('title', __('Checkout'))

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endpush

@section('content')
    <div class="container">
        <h1 class="page-title">{{ __('Checkout') }}</h1>

        <form action="{{ route('checkout.store') }}" method="post">
            @csrf

            @include('website.cart._cart-content')

            <div class="cart-page cart-page__proceed">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="firstName">{{ __('First name') }}*</label>
                                <input type="text" name="first_name" id="firstName" required>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="lastName">{{ __('Last name') }}*</label>
                                <input type="text" name="last_name" id="lastName" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="email">{{ __('Email') }}*</label>
                                <input type="email" name="email" id="email" required>
                            </div>

                            <div class="col-12 @if(! Auth::check()) col-lg-6 @endif">
                                <label for="phone">{{ __('Phone') }}*</label>
                                <input type="text" name="phone" id="phone" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="country">{{ __('Country') }}*</label>
                                <select name="country_id" id="country" autocomplete="off">
                                    @foreach($countries as $country)
                                        <option @if($country->name == 'Egypt') selected @endif
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="city">{{ __('City') }}</label>
                                <input type="text" name="city" id="city">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-9">
                                <label for="address">{{ __('Address') }}</label>
                                <input type="text" name="address" id="address">
                            </div>

                            <div class="col-12 col-lg-3">
                                <label for="post">{{ __('Post code') }}</label>
                                <input type="text" name="post" id="post">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="comment">{{ __('Comment') }}</label>
                                <textarea name="comment" id="comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="row">
                    <div class="col-12">
                        <div class="cart-page__actions">
                            <div class="row">
                                <div class="col-md-4 offset-7">
                                    <div class="row">
                                        <div class="col-md-5 offset-7">
                                            @if(env('GOOGLE_RECAPTCHA_KEY'))
                                                <div class="g-recaptcha float-right"
                                                     data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                                </div>

                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="float-right pt-3 text-danger">
                                                        <strong>{{ __('Are you a robot?') }}</strong>
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <button class="btn btn-outline-danger float-{{ isLocaleEn() ? 'right' : 'left' }}"
                                            type="submit">{{ __('Checkout') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection