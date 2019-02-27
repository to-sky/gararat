<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use \App\Models\Orders;

class SecuredOrdersController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ordersListPageSecured()
    {
        $ordersModel = new Orders;

        $data['pageTitle'] = 'Orders';
        $data['orders'] = $ordersModel->getOrders();

        return view('secured.orders.orders', $data);
    }

    public function reviewOrderPageSecured($oid)
    {
        $ordersModel = new Orders;
        $getOrder = $ordersModel->getOrderById($oid);

        $data['pageTitle'] = 'Order #' . $getOrder->oid;
        $data['order'] = $getOrder;
        $data['products'] = $ordersModel->getOrderProducts($oid);

        return view('secured.orders.order', $data);
    }
    //======================================================================
    // API
    //======================================================================
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeOrderStatusAPI(Request $request)
    {
        DB::table('orders')
            ->where('oid', $request->get('oid'))
            ->update([
                'status' => $request->get('orderStatus')
            ]);
        return redirect()->back();
    }

    /**
     * @param $oid
     * @param $nid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProductFromOrderAPI($oid, $nid)
    {
        DB::table('orders_to_nodes')->where('order', $oid)->where('node', $nid)->delete();
        return redirect()->back();
    }

    /**
     * @param $oid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeOrderAPI($oid)
    {
        DB::table('orders_to_nodes')->where('order', $oid)->delete();
        DB::table('orders')->where('oid', $oid)->delete();
        return redirect()->back();
    }
}
