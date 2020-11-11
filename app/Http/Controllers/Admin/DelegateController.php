<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DelegateStoreFormRequest;
use App\Http\Requests\DelegateUpdateFormRequest;
use App\Services\Delegates\DelegateEditUpdateService;
use App\Services\Delegates\DelegateCreateStoreService;
use App\Services\Delegates\DelegateFetshDataService;

class DelegateController extends Controller
{
    public function index()
    {
        return app(DelegateFetshDataService::class)->index();
    }
    public function show($id)
    {
        return app(DelegateFetshDataService::class)->show($id);
    }
    public function create()
    {
        return view('delegate.create');
    }

    public function store(DelegateStoreFormRequest $request)
    {
        return app(DelegateCreateStoreService::class)->store($request);
    }

    public function edit($id)
    {
        return app(DelegateEditUpdateService::class)->edit($id);
    }

    public function update(DelegateUpdateFormRequest $request , $id)
    {
        return app(DelegateEditUpdateService::class)->update($request, $id);
    }

    public function changeActive($id)
    {
        return app(DelegateEditUpdateService::class)->changeActive($id);
    }
}
