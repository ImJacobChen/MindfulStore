<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Order;
use Cart;

class OrderWasCreated extends Event
{
    use SerializesModels;

    public $order;
    public $transactionId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $transactionId)
    {
       $this->order = $order;
       $this->transactionId = $transactionId;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
