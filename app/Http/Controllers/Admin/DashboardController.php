<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardFetchDataService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return app(DashboardFetchDataService::class)->index();
    }
}
