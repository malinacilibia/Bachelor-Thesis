<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdoptionApprovedMail extends Notification
{
    protected $catName;
    protected $post;

    public function __construct(string $catName, $post)
    {
        $this->catName = $catName;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Cererea de adopție aprobată 🎉")
            ->view('emails.adoption-approved', [
                'user' => $notifiable,
                'catName' => $this->catName,
                'post' => $this->post,
            ]);
    }
}
