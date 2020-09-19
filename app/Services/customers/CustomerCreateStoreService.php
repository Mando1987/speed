<?php

namespace App\Services\customers;

use App\Models\Admin;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class CustomerCreateStoreService extends BaseService
{
    const IMAGE_PATH = 'customers/profile/';

    private $admin;
    public $route = 'customer.index';

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $newAdmin = $this->admin->create($request->validated()['admin']);

            $newCustomer = $newAdmin->customer()->create(

                array_merge($request->validated()['customer'], [

                    'image' => $this->handeImageUploadUsingIntervention($request->validated()['image'], self::IMAGE_PATH)
                ])
            );
            $newCustomer->customerInfos()->create($request->validated()['customerInfo']);
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

    public function create()
    {
        return view('customer.create');
    }
}
