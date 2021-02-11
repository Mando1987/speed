<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'address'        => 'any address',
        'special_marque' => 'any address',
        'house_number'   => '1',
        'door_number'    => '1',
        'shaka_number'   => '1',
    ];
});
