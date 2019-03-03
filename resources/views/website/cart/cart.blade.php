@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $pageTitle }}</h1>
        <div class="cart-page">
            <div class="cart-page__table">
                <table id="cartTableRenderer">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="text-right total-price">
                    Total price: $<span id="totalPriceCheckout">0</span>
                </div>
                <!-- /.total-price -->
            </div>
            <!-- /.cart-page__table -->
            <div class="cart-page__actions">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('homePage') }}" class="btn btn-home-page">Return to home page</a>
                    <!-- /.btn btn-checkout -->
                    <a href="{{ route('cartProceedPage') }}" class="btn btn-checkout">Continue</a>
                    <!-- /.btn btn-checkout -->
                </div>
                <!-- /.d-flex justify-content-between -->
            </div>
            <!-- /.cart-page__actions -->
        </div>
        <!-- /.cart-page -->
    </div>
    <!-- /.container -->
@endsection