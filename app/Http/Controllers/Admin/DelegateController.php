<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DelegateStoreFormRequest;
use App\Services\Delegates\DelegateFetshDataService;
use App\Services\Delegates\DelegateStoreService;
use Illuminate\Http\Request;

class DelegateController extends Controller
{


    public function create()
    {
       return app(DelegateFetshDataService::class)->create();
    }

    public function store(DelegateStoreFormRequest $request)
    {
        return app(DelegateStoreService::class)->handle($request);
    }
}
