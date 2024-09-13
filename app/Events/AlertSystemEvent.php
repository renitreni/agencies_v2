<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AlertSystemEvent implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $details = [];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->details = ['a', 'b'];
    }

    public function broadcastOn()
    {
        return new Channel('rescue-channel');
    }

    public function broadcastAs()
    {
        return 'broadcast-alert-system';
    }
}
