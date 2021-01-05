<?php

namespace App\Http\Repositories\Dashboard;

use App\Http\Traits\Dashboard\IndexTrait;
use App\Http\Interfaces\DashboardRepositoryInterface;

class CustomerDashboardRepository implements DashboardRepositoryInterface
{
    use IndexTrait;

    public function index()
    {
         $allStatus = $this->builedQueryOrder()->whereCustomerId(request()->adminId)->get();
        return view('dashboard.index', ['data' => $this->formatedData($allStatus)]);
    }

}
