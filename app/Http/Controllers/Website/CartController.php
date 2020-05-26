<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Part;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Show cart page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('website.cart.index');
    }

    /**
     * Store product to the cart
     *
     * @param StoreCartRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $product = Product::getProductByType($request->product_type, $request->id);

        $data = [$product, $request->qty];

        if ($product instanceof Part) {
            $data[] = ['producer_id' => $product->producer_id];
        }

        forward_static_call_array(['Cart', 'add'], $data);

        return response([
            'qty' => Cart::count()
        ]);
    }

    /**
     * Update product qty in the cart
     *
     * @param UpdateCartRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */

    public function update(UpdateCartRequest $request)
    {
        Cart::update($request->rowId, $request->qty);

        return response()->json($this->generateParams());
    }

    /**
     * Remove product from the cart
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function remove()
    {
        Cart::remove(request('rowId'));

        return response()->json($this->generateParams());
    }

    /**
     * Generate params for ajax request
     *
     * @return array
     * @throws \Throwable
     */
    protected function generateParams()
    {
        $qty = Cart::count();

        $templatePart = $qty ? '_cart-content' : '_cart-empty';

        $html = view("website.cart.$templatePart")->render();

        return compact('html', 'qty');
    }
}
