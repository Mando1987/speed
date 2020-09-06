<?php


use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Customer;

// // ############################################################################

Route::get('admin/{id}/change-active', [AdminController::class, 'changeActive'])->name('admin.changeActive');
Route::post('admin/{id}/change-passowrd', [AdminController::class, 'changePassword'])->name('admin.change_password');

Route::get('/get-cities',[CustomerController::class, 'getCities'] );

Route::resources([
    'admin' => AdminController::class,
    'role' => RoleController::class,
    'dashboard' => DashboardController::class,
    'customer' => CustomerController::class,
]);

Route::fallback(function () {

    return abort(404);
});

Route::get('test', function () {
   return (new Customer() )->getTable();
});

