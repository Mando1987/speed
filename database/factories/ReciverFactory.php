<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Reciver;
use Faker\Generator as Faker;

$factory->define(Reciver::class, function (Faker $faker) {
    return [
        'fullname'       => 'R' . $faker->name(),
        'phone'          => '0117014' . rand(0000,9999),
        'governorate_id' => 1,
        'city_id'        => 1,
        'other_phone'    =>  '0127014' . rand(0000,9999),
        'customer_id'   => factory(Customer::class)
    ];
});
