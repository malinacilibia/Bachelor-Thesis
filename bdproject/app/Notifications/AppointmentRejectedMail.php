<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentRejectedMail extends Notification
{
    use Queueable;

    protected $date;
    protected $reason;
    protected $link;

    public function __construct(string $date, string $reason, string $link)
    {
        $this->date = $date;
        $this->reason = $reason;
        $this->link = $link;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Programare respinsă')
            ->view('emails.appointment-rejected', [
                'user' => $notifiable,
                'date' => $this->date,
                'reason' => $this->reason,
                'link' => $this->link,
            ]);
    }
}
