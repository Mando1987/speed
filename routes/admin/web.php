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
use App\Http\Controllers\Admin\ReciverController;
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

Route::get('place/edit-multi-cities', [PlaceController::class, 'editMultiCites'] )->name('place.editMultiCites');
Route::post('place/update-multi-cities', [PlaceController::class, 'updateMultiCites'] )->name('place.updateMultiCites');
Route::post('place/destroy-multi-cities', [PlaceController::class, 'destroyMultiCities'] )->name('place.destroyMultiCities');
Route::get('order/view-edit-panel', [OrderController::class, 'viewEditPanel'] )->name('order.view_Edit_Panel');
Route::get('order/edit-order', [OrderController::class, 'editOrder'])->name('order.edit_order');
Route::get('order/view-delete-daialog/{id}', [OrderController::class, 'viewDeleteDaialog'] )->name('order.view_Delete_Daialog');
Route::post('order/validate-customer', [OrderController::class, 'validateCustomer'] )->name('order.validate_customer');
Route::post('order/validate-reciver', [OrderController::class, 'validateReciver'] )->name('order.validate_reciver');

Route::put('reciver/update/{id}', [ReciverController::class, 'update'] )->name('reciver.update');
Route::put('customer/updateByOrder/{id}', [CustomerController::class, 'updateByOrder'] )->name('customer.updateByOrder');

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


