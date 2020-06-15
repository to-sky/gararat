<?php

namespace App\Mail;

use App\Models\News;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $news;

    public $subscriber;

    /**
     * Create a new message instance.
     *
     * @param News $news
     * @param Subscriber $subscriber
     */
    public function __construct(News $news, Subscriber $subscriber)
    {
        $this->news = $news;
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newsletter')
                    ->subject($this->news->trans('title'));
    }
}
