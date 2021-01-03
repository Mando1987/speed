<?php
namespace App\Http\Repositories\Orders;

use App\Models\ViewSetting;
use Illuminate\Http\Request;

class OrderViewShowStore
{
    private static $viewMode = 'list';
    private static $paginate = 10;

    public static function show(Request $request)
    {
        return view('order.index.show_view_setting', ['viewSetting' => static::orderViewSetting($request)]);
    }

    public static function store(Request $request)
    {
        $setting = ViewSetting::updateOrCreate(
            [
                'admin_id' => $request->adminId,
                'event' => 'order_view_setting',
            ],
            [
                'content' => $request->orderViewSetting,
            ]
        );
        session(['orderViewSetting' => $setting->content]);
        return redirect(route('order.index'));
    }
    private static function orderViewSetting(Request $request)
    {
        $setting = ViewSetting::whereAdminId($request->adminId)
            ->whereEvent('order_view_setting')
            ->first();
        return session('orderViewSetting') ?? $setting->content ?? ['view_mode' => static::$viewMode, 'paginate' => static::$paginate];
    }
}
