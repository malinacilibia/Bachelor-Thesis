<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
class AdoptionRejectedMail extends Notification
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
            ->subject("Cerere de adopție respinsă")
            ->view('emails.adoption-rejected', [
                'user' => $notifiable,
                'catName' => $this->catName,
            ]);
    }

}
