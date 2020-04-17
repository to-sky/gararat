<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings};

class OrderExport implements FromCollection, WithHeadings
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function headings(): array
    {
        return [
            __('Product'), __('Quantity')
        ];
    }

    public function collection()
    {
         return $this->order->orderProducts->map(function ($item) {
             return [
                 $item->product->trans('name'), $item->qty
             ];
         });
    }
}
