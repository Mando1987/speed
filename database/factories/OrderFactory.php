<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Order;
use App\Models\Reciver;
use App\Models\Shipping;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'type' => 'next_day_delivery',
        'status' => $faker->randomElement(['under_review', 'under_preparation']),
        'info' => 'info',
        'notes' => 'info',
        'user_can_open_order' => 0,
        'customer_id' => factory(Customer::class),
        'reciver_id' => factory(Reciver::class)
    ];
})->afterCreating(Order::class,function($order){
    $order->shipping()->create(factory(Shipping::class)->make()->toArray());
});
