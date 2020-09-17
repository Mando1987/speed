<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DelegateStoreFormRequest;
use App\Services\Delegates\DelegateCreateStoreService;


class DelegateController extends Controller
{


    public function index()
    {

    }
    public function create()
    {
       return app(DelegateCreateStoreService::class)->create();
    }

    public function store(DelegateStoreFormRequest $request)
    {
        return app(DelegateCreateStoreService::class)->handle($request);
    }
}
