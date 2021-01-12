<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\ViewSettingRepositoryInterface;
use App\Models\ViewSetting;
use Illuminate\Http\Request;

class ViewSettingRepository implements ViewSettingRepositoryInterface
{
    private static $viewMode = 'list';
    private static $paginate = 10;

    public function show(Request $request)
    {
        return view('order.index.show_view_setting', ['viewSetting' => static::viewSetting($request)]);
    }

    public function store(Request $request)
    {
        try {
            $setting = ViewSetting::updateOrCreate(
                [
                    'admin_id' => $request->adminId,
                    'event' => 'view_setting',
                ],
                [
                    'data' => $request->viewSetting,
                ]
            );

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
        self::saveSettingToSession($setting->data);
        return redirect(route('order.index'));
    }
    /**
     * get view setting
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array ['view_mode' => 'list', 'paginate' => 10];
     */
    public static function viewSetting(Request $request): array
    {
        $data = ['view_mode' => static::$viewMode, 'paginate' => static::$paginate];

        $data = session()->has('viewSetting') ? session('viewSetting') : self::loadSetting($request) ?? $data;
        return $data;

    }
    private static function saveSettingToSession($data)
    {
        session(['viewSetting' => $data]);
    }

    private static function loadSetting($request)
    {
        $setting = ViewSetting::whereAdminId($request->adminId)
            ->whereEvent('view_setting')
            ->first();
        if ($setting) {
            self::saveSettingToSession($setting->data);
            return $setting->data;
        }
    }
}
