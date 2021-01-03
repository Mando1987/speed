<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;
use App\Http\Traits\ViewSettingTrait;
use App\Http\Requests\DelegateUpdateFormRequest;

interface DelegateRepositoryInterface
{
    public function showById($id);
    public function getAll();
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(DelegateUpdateFormRequest $request, $id);
    public function changeActive($id);
}
