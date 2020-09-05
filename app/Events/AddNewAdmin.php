<?php

namespace App\Events;

use App\Models\Admin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddNewAdmin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $admin;
    public $details;
    
    public function __construct(Admin $admin , $details ='')
    {
        $this->admin   = $admin;
        $this->details = $details;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
