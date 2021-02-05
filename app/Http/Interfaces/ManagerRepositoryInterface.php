<?php
namespace App\Http\Interfaces;

use App\Http\Requests\ManagerStoreRequest;
use App\Http\Requests\ManagerUpdateRequest;
use App\Models\Manager;

interface ManagerRepositoryInterface
{
    // public function showById($id);
    // public function getAll();
    public function create();
    public function store(ManagerStoreRequest $request);
    public function edit($id);
    public function update(ManagerUpdateRequest $request, Manager $manager);
    public function deleteById(Manager $manager);
}
