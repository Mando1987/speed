<?php

namespace App\Services\customers;

use App\Models\Admin;
use App\Services\BaseService;
use App\Services\currentAdminService;
use Illuminate\Support\Facades\DB;

class CustomerEditUpdateService extends BaseService
{
    const IMAGE_PATH = 'customers/profile/';
    private $admin;
    public $route = 'customer.index';

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function edit($customer)
    {

        return view('customer.edit', [
            'data' => [
                'customer'     => $customer,
                'admin'        => $customer->admin,
                'customerInfo' => $customer->customerInfos,
            ]
        ]);
    }

    public function update($request, $customer)
    {
        try {
            DB::beginTransaction();

            $customer->admin()->update($request->validated()['admin']);

            $customer->update(

                array_merge($request->validated()['customer'], [

                    'image' => $this->handeImageUploadUsingIntervention($request->validated()['image'], self::IMAGE_PATH)
                ])
            );
            $customer->customerInfos()->update($request->validated()['customerInfo']);
            DB::commit();
            $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_EDITED]);

            return $this->path($this->currentAdminService->route);

        } catch (\Exception $ex) {

            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);

            dd($ex->getMessage());
            return back();
        }
    }
}
