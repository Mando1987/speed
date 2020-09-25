<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\Reciver;
use App\Models\Sender;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'type'                => 'next_day_delivery',
        'status'              => $faker->randomElement(['under_review', 'cancelld' , 'under_preparation' ,'delivered' ,'postpond']),
        'info'                => 'info',
        'notes'               => 'info',
        'user_can_open_order' => 0,
        // 'sender_id'           => factory(Sender::class),
        'customer_id'         => 1,
        'reciver_id'          => factory(Reciver::class)
    ];
});
