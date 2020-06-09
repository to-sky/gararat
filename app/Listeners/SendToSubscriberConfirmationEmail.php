<?php

namespace App\Listeners;

use App\Events\Subscribe;
use App\Mail\ConfirmSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendToSubscriberConfirmationEmail
{

    /**
     * Handle the event.
     *
     * @param  Subscribe  $event
     * @return void
     */
    public function handle(Subscribe $event)
    {
        Mail::to($event->subscriber)
            ->locale($event->subscriber->locale)
            ->send(new ConfirmSubscription($event->subscriber));
    }
}
