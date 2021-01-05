<?php

namespace App\Notifications\Telegram;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Log;
use Monolog\Handler\TelegramBotHandler;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class NotifyAddNewOrder extends Notification
{
    use Queueable;

    private $chaId = '-1001175803813';
    private $order;
    private $reciverPhone;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->reciverPhone = sprintf('+20%s',$this->order->reciver->phone);
        Log::debug($this->reciverPhone);
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to($this->chaId)
            ->view('notifications.telegram.add_new_order', ['order' => $this->order , 'reciverPhone' => $this->reciverPhone])
            ->button(trans('site.telegram_review_order'), route('order.show', $this->order->id))
            ->options([
                'parse_mode' => 'HTML',
            ]);

    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
