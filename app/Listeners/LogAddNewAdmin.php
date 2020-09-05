<?php

namespace App\Listeners;

use App\Events\AddNewAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogAddNewAdmin
{
   
    public $event;
    public function __construct(AddNewAdmin $event)
    { 
        $this->event = $event;
        
    }

    public function handle($event)
    {
        $event->admin->logs()->create([
            
            'event'   => 'add_new_admin',
            'type'    => $event->admin->type,
            'details' => $event->details,
           
        ]);
    }
}
