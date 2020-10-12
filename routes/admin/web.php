<?php


use App\Models\Customer;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DelegateController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PlacePricesController;
use App\Http\Controllers\Admin\SellersouqController;

// // ############################################################################
Route::get('admin/{id}/change-active', [AdminController::class, 'changeActive'])->name('admin.changeActive');
Route::post('admin/{id}/change-passowrd', [AdminController::class, 'changePassword'])->name('admin.change_password');

Route::get('/get-cities',[PlaceController::class, 'getCities'])->withoutMiddleware('auth:admin');

Route::get('order/get-order-charge-price',[OrderController::class, 'getOrderChargePrice'] );
Route::get('order/print',[OrderController::class, 'print'] )->name('order.print');

Route::get('/price/create-place-price',[PlacePricesController::class, 'store'] );
Route::get('/delegate/changeActive/{id}',[DelegateController::class, 'changeActive'])->name('delegate.changeActive');

Route::get('customer/order/create', [CustomerController::class, 'createOrder'] )->name('customer.order.create');
Route::post('customer/order', [CustomerController::class, 'storeOrder'] )->name('customer.order.store');

Route::resources([
    'admin'        => AdminController::class,
    'role'         => RoleController::class,
    'dashboard'    => DashboardController::class,
    'customer'     => CustomerController::class,
    'place'        => PlaceController::class,
    'price'        => PlacePricesController::class,
    'order'        => OrderController::class,
    'delegate'     => DelegateController::class,
    'sellersouq'   => SellersouqController::class,
]);

Route::fallback(function () {

    return abort(404);
});

// Route::get('create-admin',function(){
//     App\Models\Admin::create(
//         [
//             'fullname'   => 'admin',
//             'phone'      => '01098026159',
//             'email'      => 'a.wahba2019@gmail.com',
//             'user_name'  => 'admin',
//             'password'   => bcrypt('3266901'),
//             'is_active'  => 1,
//             'type'       => 'manager',
//         ]
// );
// });

