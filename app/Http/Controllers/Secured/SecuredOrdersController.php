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

    public function reviewOrderPageSecured($id)
    {
        $ordersModel = new Orders;
        $getOrder = $ordersModel->getOrderById($id);

        $data['pageTitle'] = 'Order #' . $getOrder->id;
        $data['order'] = $getOrder;
        $data['products'] = $ordersModel->getOrderProducts($id);

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
            ->where('id', $request->get('id'))
            ->update([
                'status' => $request->get('orderStatus')
            ]);
        return redirect()->back();
    }

    /**
     * @param $order_id
     * @param $node_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProductFromOrderAPI($order_id, $node_id)
    {
        DB::table('orders_to_nodes')->where('order', $order_id)->where('node', $node_id)->delete();
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeOrderAPI($id)
    {
        DB::table('orders_to_nodes')->where('order', $id)->delete();
        DB::table('orders')->where('id', $id)->delete();
        return redirect()->back();
    }
}
