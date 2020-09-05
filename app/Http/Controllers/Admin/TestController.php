<?php

namespace App\Http\Controllers\Admin;

use App\PackagePrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;

class TestController extends Controller
{

  public function __invoke()
  {
    return trans('permission.admin_create');
  }
}
