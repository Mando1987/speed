<?php

namespace App\Listeners;

use App\Events\CreateNewOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Telegram\Telegram;

class SendNotificationToTelegram
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct(CreateNewOrder $event)
    {
        $this->event = $event;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // dd($event);
        $tele = new Telegram('1386311778:AAH375FJ6-rc161J4M799pbqrPMW42Eky8o');
        $tele->sendMessage([
            'chat_id' => '-1001175803813',
            'text' => view('includes.telegram.Added_new_order' , ['order' =>$event->order])->toHtml(),
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => false,
            'disable_notification' => '',
            'reply_to_message_id' => '{info:mando}',
            'reply_markup' => '',
        ]);
    }
}
