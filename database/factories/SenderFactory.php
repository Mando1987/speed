<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Sender;
use Faker\Generator as Faker;

$factory->define(Sender::class, function (Faker $faker) {

    return [
        'fullname'       => 'S' . $faker->name(),
        'phone'          => '010701426' . rand(10,99),
        'governorate_id' => 1,
        'address'        => 'any address',
        'special_marque' => 'any address',
        'house_number'   => rand(10,300),
        'door_number'    => rand(1,30),
        'shaka_number'   => 300,
        'city_id'        => 1,
        'other_phone'    =>  '015701426' . rand(10,99),
    ];
});
