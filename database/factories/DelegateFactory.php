<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use App\Models\Admin;
use App\Models\Delegate;
use Faker\Generator as Faker;

$factory->define(Delegate::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name(),
        'qualification' => 'deblom',
        'national_id' => '201287' .$faker->unixTime(),
        'social_status' => 'single',
        'governorate_id' => 1,
        'city_id' => 1,
        'address' => $faker->address,
        'admin_id' => factory(Admin::class)->create(['type' => 'delegate'])->id
    ];
})->afterCreating(Delegate::class, function ($delegate, $faker) {
    $delegate->delegateDrive()->create([
        'type' => 'motocycle',
        'color' => 'black',
        'plate_number' => 'PN' .$faker->unixTime(),
    ]);
});
