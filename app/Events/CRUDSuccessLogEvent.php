<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CRUDSuccessLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $event;
    public $userId;
    public $userMobile;
    public $model;
    public $description;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($event, $userId, $userMobile, $model, $description, $message = '')
    {
        $this->event = $event;
        $this->userId = $userId;
        $this->userMobile = $userMobile;
        $this->model = $model;
        $this->description = $description;
        $this->message =$message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
