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
     * Restore cart from database if userToken exists or create userToken
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($userToken = $request->cookie('userToken')) {
            Cart::restore($userToken);
        } else {
            Cookie::queue('userToken', Str::uuid()->toString(), config('cart.lifetime'));
        }

        return $next($request);
    }

    /**
     * Save cart to database after return response
     *
     * @param $request
     * @param $response
     */
    public function terminate($request, $response)
    {
        CartService::storeCart();
    }
}
