<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reciver;
use Faker\Generator as Faker;

$factory->define(Reciver::class, function (Faker $faker) {
    return [
        'fullname'       => 'R' . $faker->name(),
        'phone'          => '0117014' . rand(0000,9999),
        'governorate_id' => 1,
        'address'        => 'any address',
        'special_marque' => 'any address',
        'house_number'   => rand(10,300),
        'door_number'    => rand(1,30),
        'shaka_number'   => 300,
        'city_id'        => 1,
        'other_phone'    =>  '0127014' . rand(0000,9999),
    ];
});
