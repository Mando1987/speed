<?php
namespace App\Http\Repositories\Factories;

use App\Http\Interfaces\BaseFactoryInterface;
use App\Http\Interfaces\CustomerFetshDataRepositoryInterface;
use App\Http\Repositories\Customers\CustomersFetshDataRepositoryByCustomer;
use App\Http\Repositories\Customers\CustomersFetshDataRepositoryByManager;

class CustomerFetshDataFactory implements BaseFactoryInterface
{
    public static function getInstance(): CustomerFetshDataRepositoryInterface
    {
        switch (request()->adminType) {
            case 'manager':
                return new CustomersFetshDataRepositoryByManager();
                break;
            case 'customer':
                return new CustomersFetshDataRepositoryByCustomer();
                break;
        }
    }
}
