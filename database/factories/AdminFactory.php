<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'user_name' => $faker->userName(),
        'phone' => '0117014' . rand(0000, 9999),
        'email' => $faker->email,
        'password' => bcrypt(123456),
        'is_active' => 1,
    ];
});
