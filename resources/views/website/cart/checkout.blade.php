@extends('website.layouts.master')

@section('title') {{ __('Checkout') }} @endsection

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endpush

@section('content')
    <div class="container">
        <h1 class="page-title">{{ __('Checkout') }}</h1>

        <form action="{{ route('proceedOrderAPI') }}" method="post" autocomplete="off">
            @csrf
            <div class="cart-page cart-page__proceed">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="cart-page__table">
                            <table id="cartProceedTableRenderer">
                                <thead>
                                    <tr>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Product name')  }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Total price') }}</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12">
                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="firstName">{{ __('First name') }}*</label>
                                <input type="text" name="firstName" id="firstName" required>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="lastName">{{ __('Last name') }}*</label>
                                <input type="text" name="lastName" id="lastName" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            @if(! Auth::check())
                                <div class="col-12 col-lg-6">
                                    <input type="hidden" name="uid" value="guest">
                                    <label for="orderEmail">{{ __('Email') }}*</label>
                                    <input type="email" name="orderEmail" id="orderEmail" required>
                                </div>
                            @else
                                <div class="col-12">
                                    <p>{{ __('You\'re logged in as') }} {{ auth()->user()->name }}</p>
                                    <input type="hidden" name="uid" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="orderEmail" id="orderEmail" value="{{ auth()->user()->email }}" required>
                                </div>
                            @endif

                            <div class="col-12 @if(! Auth::check()) col-lg-6 @endif">
                                <label for="orderPhone">{{ __('Phone') }}*</label>
                                <input type="text" name="orderPhone" id="orderPhone" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="orderCountry">{{ __('Country') }}*</label>
                                <select name="orderCountry" id="orderCountry" autocomplete="off">
                                    @foreach($countries as $country)
                                        <option @if($country->name == 'Egypt') selected @endif
                                        value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="orderCity">{{ __('City') }}</label>
                                <input type="text" name="orderCity" id="orderCity">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-9">
                                <label for="orderAddress">{{ __('Address') }}</label>
                                <input type="text" name="orderAddress" id="orderAddress">
                            </div>

                            <div class="col-12 col-lg-3">
                                <label for="orderPost">{{ __('Post code') }}</label>
                                <input type="text" name="orderPost" id="orderPost">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="orderComment">{{ __('Comment') }}</label>
                                <textarea name="orderComment" id="orderComment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="cart-page__actions">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="{{ route('cart') }}" class="btn btn-home-page">{{ __('Return to cart') }}</a>
                                </div>

                                <div class="col-md-9">
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
                                    <button class="btn btn-checkout float-{{ isLocaleEn() ? 'right' : 'left' }}"
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