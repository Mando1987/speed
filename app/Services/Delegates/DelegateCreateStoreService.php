<?php

namespace App\Services\Delegates;

use App\Models\Delegate;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class DelegateCreateStoreService extends BaseService
{
    const IMAGE_PATH             = 'delegates/profile/';
    const IMAGE_PATH_NATIONAL_ID = 'delegates/national/';

    public $route = 'delegate.index';
    private $delegate;

    public function __construct(Delegate $delegate)
    {
        $this->delegate = $delegate;
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $createDelegate = $this->delegate::create(
                array_merge($request->validated()['delegate'], [
                    'image' => $this->handeImageUploadUsingIntervention($request->validated()['image'], self::IMAGE_PATH),
                    'national_image' => $this->handeImageUploadUsingIntervention($request->validated()['national_image'], self::IMAGE_PATH_NATIONAL_ID)
                ])
            );

            $createDelegate->delegateDrive()->create($request->validated()['delegateDrive']);

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
        return $this->viewWithGovernorates('delegate.create');
    }
}