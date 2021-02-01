<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderProduct;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Show all items
     *
     * @return Factory|View
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
     * @return Factory|View
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Change order status
     *
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function changeStatus(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->order_status
        ]);

        return back();
    }

    /**
     * Delete product from order
     *
     * @param OrderProduct $orderProduct
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteProduct(OrderProduct $orderProduct)
    {
        $orderProduct->delete();

        return back();
    }

    /**
     * Delete order
     *
     * @param Order $order
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return back();
    }
}
