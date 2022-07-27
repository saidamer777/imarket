<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WholesalerOrder implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $wholesaler_id;
    public $bill_id;
    public $products=[];
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        //
        $this->wholesaler_id=$order->wholesaler_id;
        $this->bill_id=$order->id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new channel('wholesaler_confirmation');
    }
}
