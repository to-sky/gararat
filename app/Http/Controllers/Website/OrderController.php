<?php

namespace App\Http\Controllers\Website;

use App\Rules\GoogleRecaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use DB;

use \App\Models\Order;

class OrderController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        $locale = App::getLocale();
        if($locale == 'ar') {
            $data['pageTitle'] = 'عربة التسوق';
        } else {
            $data['pageTitle'] = 'Cart';
        }
        $data['pageDescription'] = '';
        $data['countries'] = DB::table('countries')->orderBy('id', 'ASC')->get();

        return view('website.cart.checkout', $data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkoutSuccess($id)
    {
        $locale = App::getLocale();
        if($locale == 'ar') {
            $data['pageTitle'] = 'تم إنشاء الطلب بنجاح';
        } else {
            $data['pageTitle'] = 'Order created successfully';
        }
        $data['pageDescription'] = '';
        $data['id'] = $id;
        return view('website.cart.cart-success', $data);
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
        $ordersModel = new Order;
        $getCart = $ordersModel->getCurrentUserCartData($userKey);
        return response()->json(['userKey' => $userKey, 'qty' => $getCart['qty'], 'total' => $getCart['total']]);
    }

    /**
     * @param $userKey
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartTableData($userKey)
    {
        $ordersModel = new Order;
        $getCart = $ordersModel->getCartTableData($userKey);
        return response()->json(['userKey' => $userKey, 'return' => $getCart]);
    }

    /**
     * @param $userKey
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartProceedTableData($userKey)
    {
        $ordersModel = new Order;
        $getCart = $ordersModel->getCartProceedTableData($userKey);
        return response()->json(['userKey' => $userKey, 'return' => $getCart]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addItemToCart(Request $request)
    {
        $ordersModel = new Order;
        $userKey = $request->get('userKey');
        $node = $request->get('id');
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
        $ordersModel = new Order;
        $ordersModel->removeNodeFromCart($cartNode);
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function proceedOrderAPI(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => ['required', new GoogleRecaptcha()]
        ]);

        $ordersModel = new Order;
        $createOrder = $ordersModel->createOrder($request->all());

        return redirect()->route('checkout-success', $createOrder);
    }
}
