<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings};

class OrderExport implements FromCollection, WithHeadings
{
    public $order;
    public $products;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->products = $order->orderProducts;
    }

    public function headings(): array
    {
        return [
            __('Product'), __('Quantity')
        ];
    }

    public function collection()
    {
         return $this->products->map(function ($item) {
             return [
                 $item->product->trans('name'), $item->qty
             ];
         });
    }
}
