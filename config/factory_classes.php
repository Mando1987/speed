<?php

use App\Http\Interfaces\CreateOrderRepositoryInterface;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Repositories\Orders\CreateOrderRepositoryByCustomer;
use App\Http\Repositories\Orders\CreateOrderRepositoryByManager;
use App\Http\Repositories\Orders\OrderRepositoryByCustomer;
use App\Http\Repositories\Orders\OrderRepositoryByManager;
/**
 *  @return array
 */
return [
    OrderRepositoryInterface::class =>
    [
        'manager' => OrderRepositoryByManager::class,
        'customer' => OrderRepositoryByCustomer::class,
    ],
    CreateOrderRepositoryInterface::class =>
    [
        'manager' => CreateOrderRepositoryByManager::class,
        'customer' => CreateOrderRepositoryByCustomer::class,
    ],
];
