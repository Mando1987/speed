<?php

namespace App\Http\Repositories\Dashboard;

use App\Http\Interfaces\DashboardRepositoryInterface;
use App\Http\Traits\Dashboard\IndexTrait;

class ManagerDashboardRepository implements DashboardRepositoryInterface
{
    use IndexTrait;

    public function index()
    {
        return view('dashboard.index', [
            'data' => $this->formatedData($this->builedQueryOrder('charge_price')->get()),
        ]);
    }
}
