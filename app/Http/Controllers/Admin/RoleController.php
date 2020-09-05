<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Traits\RoleTrait;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    use RoleTrait;

    public function index()
    {
        return view('admin.role.index', [
            'roles' => $this->role()->getAllRoles(),
        ]);
    }

    public function create()
    {
        return view('admin.role.create', [
            'tags' => $this->getAllTags(),
            'permissions' => $this->getAllPermissions(),
        ]);
    }

    public function store(RoleRequest $request)
    {

        try {
            DB::beginTransaction();
            $this->role()->createNewRole($request->validated());
            DB::commit();
            notify('success', 'added');
            return $this->role()->path();

        } catch (\Exception $ex) {
            DB::rollback();
            notify('error', 'failed');
            return back();
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
