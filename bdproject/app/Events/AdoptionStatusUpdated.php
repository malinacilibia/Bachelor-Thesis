<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdoptionStatusUpdated implements ShouldBroadcast
{
    public $userId;
    public $postTitle;

    public function __construct($userId, $postTitle)
    {
        $this->userId = $userId;
        $this->postTitle = $postTitle;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->userId);
    }

    public function broadcastWith()
    {
        return [
            'message' => "Cererea ta de adopție pentru pisica {$this->postTitle} a fost aprobată!"
        ];
    }
}
