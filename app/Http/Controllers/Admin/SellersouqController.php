<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerSouqFormRequest;
use App\Services\SellersSouq\SellerSouqCreateStoreService;

class SellersouqController extends Controller
{

    public function create()
    {
       return app(SellerSouqCreateStoreService::class)->create();
    }

    public function store(SellerSouqFormRequest $request)
    {
       return $request->validated();
    }
}
