<?php

namespace App\Http\Repositories\Dashboard;

use App\Http\Interfaces\DashboardRepositoryInterface;
use App\Http\Traits\Dashboard\Indextrait;

class CustomerDashboardRepository implements DashboardRepositoryInterface
{
    use Indextrait;

    public function index()
    {
         $allStatus = $this->builedQueryOrder()->whereCustomerId(request()->adminId)->get();
        return view('dashboard.index', ['data' => $this->formatedData($allStatus)]);
    }

}
