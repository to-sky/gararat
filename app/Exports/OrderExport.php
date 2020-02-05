<?php

namespace App\Exports;

use App\Models\Node;
use App\Models\Orders;
use App\Models\OrdersToNodes;
use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings};

class OrderExport implements FromCollection, WithHeadings
{
    public $order;

    public function __construct(Orders $order)
    {
        $this->order = $order;
    }

    public function headings(): array
    {
        return [
            'Product',
            'Quantity',
        ];
    }

    public function collection()
    {
         return OrdersToNodes::whereOrder($this->order->id)->get()->map(function ($item) {
             return [
                 'Item' => Node::find($item->node)->n_name_en,
                 'Quantity' => $item->order_qty
             ];
         });
    }
}
