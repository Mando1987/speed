<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Sender;
use Faker\Generator as Faker;

$factory->define(Sender::class, function (Faker $faker) {

    return [
        'fullname'       => 'S' . $faker->name(),
        'phone'          => '0107014' . mt_rand(1000,9999),
        'governorate_id' => 1,
        'address'        => 'any address',
        'special_marque' => 'any address',
        'house_number'   => rand(10,300),
        'door_number'    => rand(1,30),
        'shaka_number'   => 300,
        'city_id'        => 1,
        'other_phone'    =>  '0157014' . mt_rand(1000,9999),
    ];
});
