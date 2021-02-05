<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ManagerRepositoryInterface;
use App\Http\Requests\ManagerStoreRequest;
use App\Http\Requests\ManagerUpdateRequest;
use App\Models\Manager;

class ManagerController extends Controller
{
    private $manager;
    public function __construct(ManagerRepositoryInterface $manager)
    {
        $this->manager = $manager;
    }
    public function index()
    {
        return 1;
    }
    public function create()
    {
        return view('manager.create');
    }

    public function store(ManagerStoreRequest $request)
    {
        return $this->manager->store($request);
    }

    public function update(ManagerUpdateRequest $request, Manager $manager)
    {
        return $this->manager->update($request, $manager);
    }
    public function destroy(Manager $manager)
    {
        return $this->manager->deleteById($manager);
    }
}
