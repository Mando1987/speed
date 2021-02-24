<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

<<<<<<< HEAD
=======
use App\Models\Address;
>>>>>>> d2c656900145989558441c20841e90d0eb24624d
use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'fullname' => 'C' . $faker->name(),
        'phone' => '0117014' . rand(0000, 9999),
        'governorate_id' => 1,
        'city_id' => 1,
        'other_phone' => '0127014' . rand(0000, 9999),
    ];
<<<<<<< HEAD
=======
})->afterCreating(Customer::class, function ($customer) {
    $customer->address()->create(factory(Address::class)->make()->toArray());
>>>>>>> d2c656900145989558441c20841e90d0eb24624d
});
