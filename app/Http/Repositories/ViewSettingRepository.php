<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\ViewSettingRepositoryInterface;
use App\Models\ViewSetting;
use Illuminate\Http\Request;

class ViewSettingRepository implements ViewSettingRepositoryInterface
{
    private $viewMode = 'list';
    private $paginate = 10;

    public function show(Request $request)
    {
        return view('order.index.show_view_setting', ['viewSetting' => $this->viewSetting($request)]);
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
        session(['viewSetting' => $setting->data]);
        return redirect(route('order.index'));
    }
    private function viewSetting(Request $request)
    {
        $setting = ViewSetting::whereAdminId($request->adminId)
            ->whereEvent('view_setting')
            ->first();
        return session('viewSetting') ?? $setting->data ?? ['view_mode' => $this->viewMode, 'paginate' => $this->paginate];
    }
}
