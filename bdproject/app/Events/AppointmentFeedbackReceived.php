<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AppointmentFeedbackReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $appointmentDate;

    public function __construct($userId, $appointmentDate)
    {
        $this->userId = $userId;
        $this->appointmentDate = $appointmentDate;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->userId);
    }

    public function broadcastWith()
    {
        return [
            'message' => "Ai primit un nou feedback pentru programarea din data de {$this->appointmentDate}!",
            'url' => url('/appointments')

        ];
    }
}
