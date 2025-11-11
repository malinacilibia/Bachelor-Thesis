<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ReminderNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $appointment;

    public function __construct($userId, $appointment)
    {
        Log::info('ReminderNotificationEvent constructor called', [
            'userId' => $userId,
            'appointmentId' => $appointment->id,
            'appointmentDate' => $appointment->appointment_date,
            'postName' => $appointment->post->name
        ]);

        $this->userId = $userId;
        $this->appointment = $appointment;
    }

    public function broadcastOn()
    {
        Log::info('Broadcasting on channel', [
            'channel' => 'user.' . $this->userId
        ]);

        return new PrivateChannel('user.' . $this->userId);
    }

    public function broadcastWith()
    {
        Log::info('Broadcast data', [
            'title' => 'Reminder programare',
            'body' => 'Mâine ai o programare pentru pisica ' . $this->appointment->post->name,
            'url' => route('appointments.show', $this->appointment->id)
        ]);

        return [
            'title' => 'Reminder programare',
            'body' => 'Mâine ai o programare pentru pisica ' . $this->appointment->post->name,
            'url' => route('appointments.show', $this->appointment->id),
        ];
    }
}
