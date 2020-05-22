<?php

namespace App\Http\Middleware;

use App\Services\CartService;
use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CheckCartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userToken = $request->cookie('userToken');

        if ($userToken) {
            // If exists userToken than restore old cart from database
            Cart::restore($userToken);

            // After restored, the cart was deleted from database and need to be store new instance cart to the database
            CartService::storeCart();
        } else {
            Cookie::queue('userToken', Str::uuid()->toString(), config('cart.lifetime'));
        }

        return $next($request);
    }
}
