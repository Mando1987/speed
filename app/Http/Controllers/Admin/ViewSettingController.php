<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ViewSettingRepositoryInterface;
use Illuminate\Http\Request;

class ViewSettingController extends Controller
{
    private $viewSettingRepository;

    public function __construct(ViewSettingRepositoryInterface $viewSettingRepository)
    {
        $this->viewSettingRepository = $viewSettingRepository;
    }
    public function show(Request $request)
    {
        return $this->viewSettingRepository->show($request);
    }

    public function store(Request $request)
    {
        return $this->viewSettingRepository->store($request);
    }
}
