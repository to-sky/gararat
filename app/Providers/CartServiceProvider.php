<?php

namespace App\Providers;

use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $userToken = Cookie::get('userToken');

        // Set user key for cart
        if (is_null($userToken)) {
            Cookie::queue('userToken', Str::uuid()->toString(), config('cart.lifetime'));
        } else {
            // Restore old cart from database, if exists userToken
            Cart::restore($userToken);

            // Store new cart to database
            CartService::storeCart();
        }
    }
}
