<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use \App\Models\Orders;

class OrdersController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    public function cartPage()
    {
        $data['pageTitle'] = 'Cart';
        $data['pageDescription'] = 'Description';

        return view('website.cart.cart', $data);
    }

    public function cartProceedPage()
    {
        $data['pageTitle'] = 'Cart';
        $data['pageDescription'] = '';
        $data['countries'] = DB::table('countries')->orderBy('country', 'ASC')->get();

        return view('website.cart.cart-proceed', $data);
    }
    //======================================================================
    // API
    //======================================================================
    /**
     * @param $userKey
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartPreviewData($userKey)
    {
        $ordersModel = new Orders;
        $getCart = $ordersModel->getCurrentUserCartData($userKey);
        return response()->json(['userKey' => $userKey, 'qty' => $getCart['qty'], 'total' => $getCart['total']]);
    }

    /**
     * @param $userKey
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartTableData($userKey)
    {
        $ordersModel = new Orders;
        $getCart = $ordersModel->getCartTableData($userKey);
        return response()->json(['userKey' => $userKey, 'return' => $getCart]);
    }

    /**
     * @param $userKey
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartProceedTableData($userKey)
    {
        $ordersModel = new Orders;
        $getCart = $ordersModel->getCartProceedTableData($userKey);
        return response()->json(['userKey' => $userKey, 'return' => $getCart]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addItemToCart(Request $request)
    {
        $ordersModel = new Orders;
        $userKey = $request->get('userKey');
        $node = $request->get('nid');
        $qty = $request->get('qty');
        $createCart = $ordersModel->createCart($userKey);
        $ordersModel->createCartItems($createCart, $node, $qty);
        return response()->json(['response' => 200]);
    }

    /**
     * @param $userKey
     * @param $cartNode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeItemFromCart($userKey, $cartNode)
    {
        $ordersModel = new Orders;
        $ordersModel->removeNodeFromCart($cartNode);
        return redirect()->back();
    }
}
