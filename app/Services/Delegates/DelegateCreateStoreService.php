<?php

namespace App\Services\Delegates;

use App\Models\Admin;
use App\Models\Delegate;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class DelegateCreateStoreService extends BaseService
{
    const IMAGE_PATH             = 'delegates/profile/';
    const IMAGE_PATH_NATIONAL_ID = 'delegates/national/';

    public $route = 'delegate.index';
    private $delegate;

    protected $admin;

    public function __construct(Delegate $delegate , Admin $admin)
    {
        $this->delegate = $delegate;
        $this->admin = $admin;
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $admin = $this->admin->create($request->validated()['admin']);
            $createDelegate = $admin->delegate()->create(
                array_merge($request->validated()['delegate'], [
                    'image' => $this->handeImageUploadUsingIntervention($request->validated()['image'], self::IMAGE_PATH),
                    'national_image' => $this->handeImageUploadUsingIntervention($request->validated()['national_image'], self::IMAGE_PATH_NATIONAL_ID)
                ])
            );

            $createDelegate->delegateDrive()->create($request->validated()['delegateDrive']);
            DB::commit();
            $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_ADDED]);
            return response()->json(['urlRedirect' => route('delegate.index'),'status' => 200 , 'message' => 'ok']);

        } catch (\Exception $ex) {

            DB::rollback();
           return response()->json(['status' => 500 , 'message' => $ex->getMessage()]);
        }
    }


}
