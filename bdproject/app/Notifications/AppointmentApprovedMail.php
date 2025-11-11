<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentApprovedMail extends Notification
{
    use Queueable;

    protected $date;
    protected $link;

    public function __construct(string $date, string $link)
    {
        $this->date = $date;
        $this->link = $link;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Programare aprobată')
            ->view('emails.appointment-approved', [
                'user' => $notifiable,
                'date' => $this->date,
                'link' => $this->link,
            ]);
    }
}

