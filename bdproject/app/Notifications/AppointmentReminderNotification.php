<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
class AppointmentReminderNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => '🌟 Nu uita ca mâine ai o programare specială pentru micuța pisică ' . $this->appointment->post->title . '!  Nu uita să te pregătești pentru o întâlnire minunată! ',
            'url' => url('/appointments'),
            'type' => 'reminder',
        ];
    }
}
