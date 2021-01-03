<?php

use App\Http\Interfaces\CreateOrderRepositoryInterface;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Repositories\Orders\CreateOrderRepositoryByCustomer;
use App\Http\Repositories\Orders\CreateOrderRepositoryByManager;
use App\Http\Repositories\Orders\OrderRepositoryByCustomer;
use App\Http\Repositories\Orders\OrderRepositoryByManager;
use App\Models\Order;

/**
 *  @return array
 */
return [
    OrderRepositoryInterface::class =>
    [
        'manager'  => ['class'=> OrderRepositoryByManager::class, 'args' => [new Order]],
        'customer' => ['class'=> OrderRepositoryByCustomer::class, 'args' => [new Order]],
    ],
    CreateOrderRepositoryInterface::class =>
    [
        'manager' => CreateOrderRepositoryByManager::class,
        'customer' => CreateOrderRepositoryByCustomer::class,
    ],
];
