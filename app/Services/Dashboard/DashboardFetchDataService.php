<?php

namespace App\Services\Dashboard;

use Str;
use App\Services\BaseService;

class DashboardFetchDataService extends BaseService
{

    public function index($request)
    {
        return $this->identify($request)->index($this->admin);
    }
}
