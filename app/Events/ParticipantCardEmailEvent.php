<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ParticipantCardEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $participants;
    public $product;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($participants, $product)
    {
        $this->participants = $participants;
        $this->product = $product;
    }
}
