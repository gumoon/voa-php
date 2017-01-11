<?php

namespace voa\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WxUserInfo
{
    use InteractsWithSockets, SerializesModels;

    public $openid;

    public $userInfo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($openid, $userInfo)
    {
        $this->openid = $openid;
        $this->userInfo = $userInfo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
