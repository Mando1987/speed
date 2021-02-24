<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Order;
<<<<<<< HEAD
use App\Models\Reciver;
=======
>>>>>>> d2c656900145989558441c20841e90d0eb24624d
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'type' => 'next_day_delivery',
<<<<<<< HEAD
        'status' => $faker->randomElement(['under_review', 'under_preparation']),
        'info' => 'info',
        'notes' => 'info',
        'user_can_open_order' => 0,
        'customer_id' => factory(Customer::class),
        'reciver_id' => factory(Reciver::class),
=======
        // 'status' => $faker->randomElement(['under_review', 'under_preparation']),
        'info' => 'info',
        'notes' => 'info',
        'user_can_open_order' => 0,
>>>>>>> d2c656900145989558441c20841e90d0eb24624d
    ];
});
