<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StoryApprovedNotification extends Notification
{
    use Queueable;

    public $storyTitle;

    public function __construct($storyTitle)
    {
        $this->storyTitle = $storyTitle;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Povestea ta „{$this->storyTitle}” a fost aprobată! 🎉",
            'url' => route('my.stories'),
        ];
    }
}
