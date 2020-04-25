<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AuditProfessionalSetting
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $event_type;
    public $professional_setting;

    /**
     * Create a new event instance.
     *
     * @param $user_id
     * @param $event_type
     * @param $professional_setting
     */


    public function __construct($user, $event_type, $professional_setting)
    {
        $this->user = $user;
        $this->event_type = $event_type;
        $this->professional_setting = $professional_setting;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
