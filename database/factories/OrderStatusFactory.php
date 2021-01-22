<?php

use App\Models\OrderStatus;

/** @var \Illuminate\Database\Eloquent\Factory $factory */


$factory->define(OrderStatus::class, function () {

    return [
        'step' => 'possibility_of_delivery',
        'status' => 'under_preparation',
    ];
});
