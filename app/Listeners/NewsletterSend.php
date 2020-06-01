<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use App\Mail\NewsletterNotification;
use App\Models\Subscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewsletterSend implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 25;

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 60;

    /**
     * Handle the event.
     *
     * @param  NewsCreated  $event
     * @return void
     */
    public function handle(NewsCreated $event)
    {
        Subscriber::all()->each(function ($subscriber) use ($event) {
            Mail::to($subscriber)
                ->locale($subscriber->locale)
                ->queue(new NewsletterNotification($event->news, $subscriber));
        });
    }
}
