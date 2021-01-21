<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'address'        => 'any address',
        'special_marque' => 'any address',
        'house_number'   => rand(10,300),
        'door_number'    => rand(1,30),
        'shaka_number'   => 300,
    ];
});
