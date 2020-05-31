<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Country;
use App\Models\Subscriber;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    /** Show checkout page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if (Cart::content()->isEmpty()) {
            return redirect('cart');
        }

        return view('website.checkout.index', ['countries' => Country::all()]);
    }

    /**
     * Create order
     *
     * @param CheckoutRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CheckoutRequest $request)
    {
        $order = Order::create($request->all());

        $order->appendProducts();

        if ($request->subscribe) {
            Subscriber::create([
                'email' => $request->email,
                'locale' => session('locale')
            ]);
        }

        return view('website.checkout.success', compact('order'));
    }
}
