<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Orders;

class OrdersController extends Controller
{
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
}
