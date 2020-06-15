<?php

namespace App\Mail;

use App\Exports\OrderExport;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;


class OrderCreatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order-created')
                    ->subject(__('Order created'))
                    ->attach(
                        Excel::download(new OrderExport($this->order), 'order.xlsx')
                            ->getFile(), ['as' => 'order.xlsx']
                    );
    }
}
