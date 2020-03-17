@extends('website.layouts.master')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $pageTitle }}</h1>
        <form action="{{ route('proceedOrderAPI') }}" method="post" autocomplete="off">
            @csrf
            <div class="cart-page cart-page__proceed">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="cart-page__table">
                            <table id="cartProceedTableRenderer">
                                <thead>
                                <tr>
                                    @if(App::isLocale('en'))
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    @else
                                        <th>صورة </th>
                                        <th>إسم المنتج </th>
                                        <th>الكمية </th>
                                        <th>السعر الاجمالى </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <!-- /.cart-page__table -->
                    </div>
                    <!-- /.col-12 col-lg-8 -->
                    <div class="col-12 col-lg-12">
                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="firstName">
                                    @if(App::isLocale('en'))
                                        First Name*
                                    @else
                                        الاسم الاول
                                    @endif
                                </label>
                                <input type="text" name="firstName" id="firstName" required>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                            <div class="col-12 col-lg-6">
                                <label for="lastName">
                                    @if(App::isLocale('en'))
                                        Last Name*
                                    @else
                                        الكنية
                                    @endif
                                </label>
                                <input type="text" name="lastName" id="lastName" required>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                        </div>
                        <!-- /.form-group row -->
                        <div class="form-group row">
                            @if(!Auth::check())
                                <div class="col-12 col-lg-6">
                                    <input type="hidden" name="uid" value="guest">
                                    <label for="orderEmail">
                                        @if(App::isLocale('en'))
                                            Email*
                                        @else
                                            البريد الاليكترونى
                                        @endif
                                    </label>
                                    <input type="email" name="orderEmail" id="orderEmail" required>
                                </div>
                            @else
                                <div class="col-12">
                                    <p>You're logged in as {{ Auth::user()->name }}</p>
                                    <input type="hidden" name="uid" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="orderEmail" id="orderEmail" value="{{ Auth::user()->email }}" required>
                                </div>
                                <!-- /.col-12 -->
                            @endif
                            <!-- /.col-12 col-lg-6 -->
                            <div class="col-12 @if(!Auth::check()) col-lg-6 @endif">
                                <label for="orderPhone">
                                    @if(App::isLocale('en'))
                                        Phone*
                                    @else
                                        رقم الهاتف
                                    @endif
                                </label>
                                <input type="text" name="orderPhone" id="orderPhone" required>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="orderCountry">
                                    @if(App::isLocale('en'))
                                        Country*
                                    @else
                                        الدولة
                                    @endif
                                </label>
                                <select name="orderCountry" id="orderCountry" autocomplete="off">
                                    @foreach($countries as $country)
                                        <option @if($country->country == 'Egypt') selected @endif value="{{ $country->country }}">{{ $country->country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                            <div class="col-12 col-lg-6">
                                <label for="orderCity">
                                    @if(App::isLocale('en'))
                                        City
                                    @else
                                        المدينة
                                    @endif
                                </label>
                                <input type="text" name="orderCity" id="orderCity">
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                        </div>
                        <!-- /.form-group row -->
                        <div class="form-group row">
                            <div class="col-12 col-lg-9">
                                <label for="orderAddress">
                                    @if(App::isLocale('en'))
                                        Address
                                    @else
                                        العنوان
                                    @endif
                                </label>
                                <input type="text" name="orderAddress" id="orderAddress">
                            </div>
                            <!-- /.col-12 col-lg-9 -->
                            <div class="col-12 col-lg-3">
                                <label for="orderPost">
                                    @if(App::isLocale('en'))
                                        Post Code
                                    @else
                                        الرقم البريدى
                                    @endif
                                </label>
                                <input type="text" name="orderPost" id="orderPost">
                            </div>
                            <!-- /.col-12 col-lg-3 -->
                        </div>
                        <!-- /.form-group row -->
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="orderComment">
                                    @if(App::isLocale('en'))
                                        Comment
                                    @else
                                        تعليقات
                                    @endif
                                </label>
                                <textarea name="orderComment" id="orderComment"></textarea>
                            </div>
                            <!-- /.col-12 -->
                        </div>
                        <!-- /.form-group row -->
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <!--
                        <div class="text-right total-price">
                            Total price: $<span id="totalPriceCheckout">0</span>
                        </div>
                        -->
                        <!-- /.total-price -->
                        <div class="cart-page__actions">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="{{ route('cartPage') }}" class="btn btn-home-page">
                                        @if(App::isLocale('en'))
                                            Return to cart
                                        @else
                                            العودة إلى السلة
                                        @endif
                                    </a>
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
                                                        <strong>Are you a robot?</strong>
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-1">
                                    <button class="btn btn-checkout float-right" type="submit">
                                        @if(App::isLocale('en'))
                                            Checkout
                                        @else
                                            الدفع
                                        @endif
                                    </button>
                                </div>
                            </div>
                            <!-- /.d-flex justify-content-between -->
                        </div>
                        <!-- /.cart-page__actions -->
                    </div>
                    <!-- /.col-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.cart-page -->
        </form>
    </div>
    <!-- /.container -->
@endsection
