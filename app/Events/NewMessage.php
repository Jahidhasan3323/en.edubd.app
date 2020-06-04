<?php

namespace App\Events;

use App\Chatting;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatting; 
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Chatting $chatting)
    {
        $this->chatting = $chatting;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chattings');
    }
    public function broadcastWith()
    {
        $this->chatting->load('fromContact');
        return ['chatting' => $this->chatting];
    }


}
