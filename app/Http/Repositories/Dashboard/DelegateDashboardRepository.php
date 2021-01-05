<?php

namespace App\Http\Repositories\Dashboard;

use App\Http\Interfaces\DashboardRepositoryInterface;

class DelegateDashboardRepository implements DashboardRepositoryInterface
{
    public function index()
    {
        return 'manager';
    }
}
