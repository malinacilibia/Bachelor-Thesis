<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class StoryApproved implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $userId;
    public $storyTitle;

    public function __construct($userId, $storyTitle)
    {
        $this->userId = $userId;
        $this->storyTitle = $storyTitle;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->userId);
    }

    public function broadcastWith()
    {
        return [
            'message' => "Povestea ta „{$this->storyTitle}” a fost aprobată! ",
            'url' => route('my.stories'),
        ];
    }

    public function broadcastAs()
    {
        return 'story.approved';
    }
}
