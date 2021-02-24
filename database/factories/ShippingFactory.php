<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Shipping;
use Faker\Generator as Faker;

$factory->define(Shipping::class, function () {

    return [
<<<<<<< HEAD
        'weight'                  => 0.5,
        'quantity'                =>  4,
        'price'                   => 500,
        'charge_price'            => 100,
        'total_price'             => 600,
        'charge_on'               => 'reciver',
        'total_weight'            => 2,
        'total_over_weight'       => 1,
        'total_over_weight_price' => 50,
        'discount'                => 0,
         'order_id'                => factory(Order::class),
        'order_num'               => rand(4444,9999),
=======
        'weight' => '0.5',
        'quantity' => '4',
        'price' => '500',
        'charge_price' => '100',
        'total_price' => '600',
        'charge_on' => 'reciver',
        'total_weight' => '2',
        'total_over_weight' => '1',
        'total_over_weight_price' => '50',
        'discount' => '0',
        // 'order_num' => rand(4444, 9999),
>>>>>>> d2c656900145989558441c20841e90d0eb24624d
    ];
});
