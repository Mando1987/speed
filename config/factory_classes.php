<?php

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Repositories\Factories\OrderFactory;
use App\Http\Repositories\Orders\CreateOrderByCustomer;
use App\Http\Repositories\Orders\OrderRepositoryByManager;

return [
    OrderRepositoryInterface::class =>
    [
        'manager' => OrderRepositoryByManager::class,
        'customer' => CreateOrderByCustomer::class,
    ],
];
