<?php
namespace App\Http\Repositories\Factories;

use App\Http\Interfaces\BaseFactoryInterface;
use App\Http\Interfaces\OrderGetAllRepositoryInterface;
use App\Http\Repositories\Orders\OrderByDelegateRepository;
use App\Http\Repositories\Orders\OrderRepositoryByCustomer;
use App\Http\Repositories\Orders\OrderRepositoryByManager;
use App\Models\Order;

class OrderFactory implements BaseFactoryInterface
{
    public static function getInstance(): OrderGetAllRepositoryInterface
    {
        switch (request()->adminType) {
            case 'manager':
                return new OrderRepositoryByManager(new Order);
                break;
            case 'customer':
                return new OrderRepositoryByCustomer(new Order);
                break;
            case 'delegate':
                return new OrderByDelegateRepository(new Order);
                break;
        }
    }
}
