<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderCreatedSendMailNotification
{
    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        Mail::to([$event->order->email, config('mail.to.sales')])->send(new OrderCreatedNotification($event->order));
    }
}
