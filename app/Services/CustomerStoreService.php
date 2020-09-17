<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class CustomerStoreService extends BaseService
{
    const IMAGE_PATH = 'customers/';

    private $admin ;
    public $route = 'customer.index';

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function handle($request)
    {
        //   dd($request);
        try {


            DB::beginTransaction();

            $newAdmin = $this->admin->create($request['admin']);

            $newCustomer = $newAdmin->customer()->create(

               array_merge($request['customer'],[

                    'image' => $this->handeImageUploadUsingIntervention($request['customer']['image'], self::IMAGE_PATH)
                ])

            );
            $newCustomer->customerInfos()->create($request['customerInfos']);


            // event(new AddNewAdmin(auth('customer')->user() , $details = $request['customer']['fullname'] ));

            DB::commit();
            $this->notify(['icon' => self::ICON_SUCCESS ,'title' => self::TITLE_ADDED]);
            return $this->path($this->route);

        } catch (\Exception $ex) {

            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR ,'title' => self::TITLE_FAILED]);

            dd($ex->getMessage());
            return back();
        }

    }

}
