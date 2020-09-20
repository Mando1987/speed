<?php

namespace App\Services\SellersSouq;

use App\Models\Admin;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SellerSouqCreateStoreService extends BaseService
{
    const IMAGE_PATH = 'sellersouq/profile/';

    private $admin;
    public $route = 'sellersouq.index';

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
        $order_num = request('order_num') ?? 1;
            return view('sellersouq.create' , ['order_num' => $order_num ]);

    }
}
