<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Notifications\PushUpNotification;

class AppointmentStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $appointmentDate;

    public function __construct($userId, $appointmentDate, $url = null)
    {
        $this->userId = $userId;
        $this->appointmentDate = $appointmentDate;
        $this->url = $url;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->userId);
    }

    public function broadcastWith()
    {
        return [
            'message' => "Programarea ta din data de {$this->appointmentDate} a fost confirmată!",
            'url' => url('/appointments')
        ];
    }

}
