<?php


use App\Models\Customer;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PlacePricesController;

// // ############################################################################

Route::get('admin/{id}/change-active', [AdminController::class, 'changeActive'])->name('admin.changeActive');
Route::post('admin/{id}/change-passowrd', [AdminController::class, 'changePassword'])->name('admin.change_password');

Route::get('/get-cities',[PlaceController::class, 'getCities'] );


Route::get('order/get-order-charge-price',[OrderController::class, 'getOrderChargePrice'] );



Route::resources([
    'admin'        => AdminController::class,
    'role'         => RoleController::class,
    'dashboard'    => DashboardController::class,
    'customer'     => CustomerController::class,
    'place'        => PlaceController::class,
    'price'        => PlacePricesController::class,
    'order'        => OrderController::class,
]);

Route::fallback(function () {

    return abort(404);
});

Route::get('test', function () {
   return (new Customer() )->getTable();
});

