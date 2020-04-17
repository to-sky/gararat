@extends('website.layouts.master')

@section('title', __('Cart'))

@section('content')
    <div class="container">
        <h1 class="page-title">{{ __('Cart') }}</h1>

        <div id="cartContainer" class="position-relative">
            <div id="cartContent">
                @if(Cart::content()->isNotEmpty())
                    @include('website.cart._cart-content')
                @else
                    @include('website.cart._cart-empty')
                @endif
            </div>

        </div>
    </div>
@endsection