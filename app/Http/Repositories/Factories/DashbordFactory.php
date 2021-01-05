<?php
namespace App\Http\Repositories\Factories;

use App\Http\Interfaces\BaseFactoryInterface;
use App\Http\Interfaces\DashboardRepositoryInterface;
use App\Http\Repositories\Dashboard\CustomerDashboardRepository;
use App\Http\Repositories\Dashboard\DelegateDashboardRepository;
use App\Http\Repositories\Dashboard\ManagerDashboardRepository;

class DashbordFactory implements BaseFactoryInterface
{
    public static function getInstance(): DashboardRepositoryInterface
    {
        switch (request()->adminType) {
            case 'manager':
                return new ManagerDashboardRepository;
                break;
            case 'customer':
                return new CustomerDashboardRepository;
                break;
            case 'delegate':
                return new DelegateDashboardRepository;
                break;
            default:
                abort(404);
                break;
        }
    }
}
