<?php

namespace App\Http\Controllers\Admin;

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






    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->get('orderStatus')
        ]);

        return redirect()->back();
    }

    /**
     * @param Order $order
     * @param $productIds
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProducts(Order $order, $productIds)
    {
        $order->products()->whereIn('id', $productIds)->map->delete();

        return redirect()->back();
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->back();
    }
}
