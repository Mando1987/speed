<?php

use App\Events\AddNewAdmin;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Admin;
use Illuminate\Routing\RouteGroup;

// // ############################################################################

Route::get('admin/{id}/change-active', [AdminController::class, 'changeActive'])->name('admin.changeActive');
Route::post('admin/{id}/change-passowrd', [AdminController::class, 'changePassword'])->name('admin.change_password');

Route::resources([
    'admin' => AdminController::class,
    'role' => RoleController::class,
    'dashboard' => DashboardController::class,
    'customer' => CustomerController::class,
]);

Route::fallback(function () {

    return abort(404);
});

