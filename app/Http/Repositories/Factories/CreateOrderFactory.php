<?php
namespace App\Http\Repositories\Factories;

use App\Http\Interfaces\BaseFactoryInterface;
use App\Http\Interfaces\CreateOrderRepositoryInterface;
use App\Http\Repositories\Orders\CreateOrderRepositoryByCustomer;
use App\Http\Repositories\Orders\CreateOrderRepositoryByManager;

class CreateOrderFactory implements BaseFactoryInterface
{
    public static function getInstance(): CreateOrderRepositoryInterface
    {
        switch (request()->adminType) {
            case 'manager':
                return new CreateOrderRepositoryByManager();
                break;
            case 'customer':
                return new CreateOrderRepositoryByCustomer();
                break;
        }
    }
}
