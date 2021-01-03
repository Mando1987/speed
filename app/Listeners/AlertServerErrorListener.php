<?php

namespace App\Listeners;

use App\Events\ServerErrorEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Services\AlertFormatedDataJson;

class AlertServerErrorListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ServerErrorEvent $event)
    {
        return response()->json(['target' => 'serverError'],500);
        return AlertFormatedDataJson::alertServerError($event->routeName);
    }
}
