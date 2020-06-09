<?php

namespace App\Events;

use App\Models\Subscriber;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Subscribe
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $subscriber;

    /**
     * Create a new event instance.
     *
     * @param Subscriber $subscriber
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }
}
