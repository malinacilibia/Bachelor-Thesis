<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AppointmentRejected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $message;
    public $url;

    public function __construct($userId, $appointmentDate)
    {
        $this->userId = $userId;
        $this->message = "Cererea ta pentru programarea din data de {$appointmentDate} a fost respinsă.";
        $this->url = url('/appointments');
    }

    public function broadcastOn()
    {
        return new PrivateChannel("private-user.{$this->userId}");
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'url' => $this->url
        ];
    }
}
