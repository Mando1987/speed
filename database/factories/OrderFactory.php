<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'type' => 'next_day_delivery',
        'status' => $faker->randomElement(['under_review', 'under_preparation']),
        'info' => 'info',
        'notes' => 'info',
        'user_can_open_order' => 0,
    ];
});
