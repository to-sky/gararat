<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $post;

    public $subscriber;

    /**
     * Create a new message instance.
     *
     * @param Post $post
     * @param Subscriber $subscriber
     */
    public function __construct(Post $post, Subscriber $subscriber)
    {
        $this->post = $post;
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
                    ->subject($this->post->trans('title'));
    }
}
