<?php

namespace App\Listeners;

use App\Events\PostCreated;
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
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        Subscriber::active()->get()->each(function ($subscriber) use ($event) {
            Mail::to($subscriber)
                ->locale($subscriber->locale)
                ->queue(new NewsletterNotification($event->post, $subscriber));
        });
    }
}
