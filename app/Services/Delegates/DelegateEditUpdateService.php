<?php

namespace App\Services\Delegates;

use App\Models\Delegate;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class DelegateEditUpdateService extends BaseService
{
    const IMAGE_PATH             = 'delegates/profile/';
    const IMAGE_PATH_NATIONAL_ID = 'delegates/national/';

    public $route = 'delegate.index';
    private $delegate;

    public function __construct(Delegate $delegate)
    {
        $this->delegate = $delegate;
    }

    public function handle($request)
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

    public function edit($id)
    {
        return $this->viewWithGovernorates('delegate.edit');
    }

    public function changeActive($id)
    {
        try {

            $delegateEnabled = $this->delegate::findOrFail($id);

            $active = $delegateEnabled->active == 1 ? 0 : 1;
            $message = trans('site.delegate_set_active_' . $active);
            $text = trans('site.delegate_get_active_' . $active);

            $delegateEnabled->update(['active' => $active]);

            return ['code' => 1, 'title' => trans('site.success_title'), 'message' => $message, 'text' => $text];
        } catch (\Exception $ex) {

            return ['code' => 2, 'title' => trans('site.failed_title'), 'message' => trans('site.failed')];
        }
    }
}
