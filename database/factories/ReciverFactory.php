<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reciver;
use Faker\Generator as Faker;

$factory->define(Reciver::class, function (Faker $faker) {
    return [
        'fullname'       => 'R' . $faker->name(),
        'phone'          => '011701426' . rand(10,99),
        'governorate_id' => 1,
        'address'        => 'any address',
        'special_marque' => 'any address',
        'house_number'   => rand(10,300),
        'door_number'    => rand(1,30),
        'shaka_number'   => 300,
        'city_id'        => 1,
        'other_phone'    =>  '012701426' . rand(10,99),
    ];
});
