<?php

namespace App\Services\Registers;

use App\Models\Admin;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class RegisterService extends BaseService
{

    public $admin;

    public function __construct(Admin $admin)
    {

        $this->admin = $admin;
    }

    public function registerStore($request)
    {
        // dd($request);
        try {
            DB::beginTransaction();

            $newAdmin = $this->admin->create($request->validated()['admin']);

            $newCustomer = $newAdmin->customer()->create($request->validated()['customer']);

            $newCustomer->address()->create($request->validated()['address']);

            session()->forget('facebook');
            auth('admin')->login($newAdmin);


            DB::commit();
            $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_ADDED]);
            return $this->path($this->route);
        } catch (\Exception $ex) {

            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);
            dd($ex->getMessage());
            return back();
        }
    }
}
