<?php

namespace App\Events;

use App\Channel;

use Illuminate\Broadcasting\Channel as BroadcastingChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class NewAnnouncement implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channel;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('Channel.'.$this->channel->id);
    }
}
