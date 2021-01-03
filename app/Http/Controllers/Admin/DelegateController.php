<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\DelegateRepositoryInterface;
use App\Http\Requests\DelegateStoreFormRequest;
use App\Http\Requests\DelegateUpdateFormRequest;

class DelegateController extends Controller
{
    private $delegateRepository;

    public function __construct(DelegateRepositoryInterface $delegateRepository)
    {
        $this->delegateRepository = $delegateRepository;
    }
    public function index()
    {
        return $this->delegateRepository->getAll();
    }
    public function show($id)
    {
        return $this->delegateRepository->showById($id);
    }
    public function create()
    {
        return $this->delegateRepository->create();
    }

    public function store(DelegateStoreFormRequest $request)
    {
       return $this->delegateRepository->store($request);
    }

    public function edit($id)
    {
        return $this->delegateRepository->edit($id);
    }

    public function update(DelegateUpdateFormRequest $request, $id)
    {
        return $this->delegateRepository->update($request, $id);
    }

    public function changeActive($id)
    {
        return $this->delegateRepository->changeActive($id);
    }
}
