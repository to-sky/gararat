<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Show all items
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::latest()->paginate()
        ]);
    }

    /**
     * Edit item
     *
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
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
