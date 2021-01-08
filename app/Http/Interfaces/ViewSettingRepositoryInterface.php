<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface ViewSettingRepositoryInterface
{
    public function show(Request $request);
    public function store(Request $request);
}
