<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ViewSettingRepositoryInterface;
use Illuminate\Http\Request;

class ViewSettingController extends Controller
{
    private $_viewSettingRepository;

    /**
     * Insert new
     *
     * @param $viewSetting ViewSettingRepositoryInterface
     */
    public function __construct(ViewSettingRepositoryInterface $viewSetting)
    {
        $this->_viewSettingRepository = $viewSetting;
    }
    /**
     * Insert new
     *
     * @param $request Request
     */
    public function show(Request $request)
    {
        return $this->_viewSettingRepository->show($request);
    }

    public function store(Request $request)
    {
        return $this->_viewSettingRepository->store($request);
    }
}
