<?php

namespace App\Notifications\Telegram;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class NotifyAddNewOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $chaId = '-1001175803813';
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
        // Optional recipient user id.
            ->to($this->chaId)
        // (Optional) Blade template for the content.
            ->view('notifications.telegram.add_new_order', ['order' => $this->order])

        // (Optional) Inline Buttons
            ->button(trans('site.telegram_review_order'), route('order.show' , $this->order->id))
            ->options([
                'parse_mode' => 'HTML'
            ]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
