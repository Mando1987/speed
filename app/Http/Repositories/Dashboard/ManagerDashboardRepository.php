<?php

namespace App\Http\Repositories\Dashboard;

use App\Http\Interfaces\DashboardRepositoryInterface;
use App\Http\Traits\Dashboard\Indextrait;

class ManagerDashboardRepository implements DashboardRepositoryInterface
{
    use Indextrait;

    public function index()
    {
        return view('dashboard.index', [
            'data' => $this->formatedData($this->builedQueryOrder('charge_price')->get()),
        ]);
    }

}
