<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Factories\DashbordFactory;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return DashbordFactory::getInstance()->index();
    }
}
