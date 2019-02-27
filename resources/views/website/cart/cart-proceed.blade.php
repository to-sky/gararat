@extends('layouts.app')

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
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
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
                                <label for="firstName">First Name*</label>
                                <input type="text" name="firstName" id="firstName" required>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                            <div class="col-12 col-lg-6">
                                <label for="firstName">First Name*</label>
                                <input type="text" name="firstName" id="firstName" required>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                        </div>
                        <!-- /.form-group row -->
                        <div class="form-group row">
                            @if(!Auth::check())
                                <div class="col-12 col-lg-6">
                                    <label for="orderEmail">Email*</label>
                                    <input type="email" name="orderEmail" id="orderEmail" required>
                                </div>
                            @else
                                <div class="col-12">
                                    <p>You're logged in as {{ Auth::user()->name }}</p>
                                    <input type="hidden" name="orderEmail" id="orderEmail" value="{{ Auth::user()->email }}" required>
                                </div>
                                <!-- /.col-12 -->
                            @endif
                            <!-- /.col-12 col-lg-6 -->
                            <div class="col-12 @if(!Auth::check()) col-lg-6 @endif">
                                <label for="orderPhone">Phone*</label>
                                <input type="text" name="orderPhone" id="orderPhone" required>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="orderCountry">Country*</label>
                                <select name="orderCountry" id="orderCountry" autocomplete="off">
                                    @foreach($countries as $country)
                                        <option @if($country->country == 'Egypt') selected @endif value="{{ $country->country }}">{{ $country->country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                            <div class="col-12 col-lg-6">
                                <label for="orderCity">City</label>
                                <input type="text" name="orderCity" id="orderCity">
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                        </div>
                        <!-- /.form-group row -->
                        <div class="form-group row">
                            <div class="col-12 col-lg-9">
                                <label for="orderAddress">Address</label>
                                <input type="text" name="orderAddress" id="orderAddress">
                            </div>
                            <!-- /.col-12 col-lg-9 -->
                            <div class="col-12 col-lg-3">
                                <label for="orderPost">Post Code</label>
                                <input type="text" name="orderPost" id="orderPost">
                            </div>
                            <!-- /.col-12 col-lg-3 -->
                        </div>
                        <!-- /.form-group row -->
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="orderComment">Comment</label>
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
                        <div class="text-right total-price">
                            Total price: $<span id="totalPriceCheckout">0</span>
                        </div>
                        <!-- /.total-price -->
                        <div class="cart-page__actions">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('cartPage') }}" class="btn btn-home-page">Return to cart</a>
                                <!-- /.btn btn-checkout -->
                                <button class="btn btn-checkout" type="submit">Checkout</button>
                                <!-- /.btn btn-checkout -->
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
