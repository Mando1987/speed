<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DelegateStoreFormRequest;
use App\Services\Delegates\DelegateEditUpdateService;
use App\Services\Delegates\DelegateCreateStoreService;
use App\Services\Delegates\DelegateFetshDataService;

class DelegateController extends Controller
{
    public function index()
    {
        return app(DelegateFetshDataService::class)->index();
    }
    public function create()
    {
        return app(DelegateCreateStoreService::class)->create();
    }

    public function store(DelegateStoreFormRequest $request)
    {
        return app(DelegateCreateStoreService::class)->handle($request);
    }

    public function edit($id)
    {
        return app(DelegateEditUpdateService::class)->edit($id);
    }


    public function changeActive($id)
    {
       return app(DelegateEditUpdateService::class)->changeActive($id);
    }
}
