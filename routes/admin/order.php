<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\ViewSettingController;
// // ############################################################################
Route::post('order/get-order-charge-price', [OrderController::class, 'getOrderChargePrice']);
Route::get('order/print-invoice', [OrderController::class, 'printInvoice'])->name('order.print');

Route::get('customer/order/create', [CustomerController::class, 'createOrder'])->name('customer.order.create');
Route::post('customer/order', [CustomerController::class, 'storeOrder'])->name('customer.order.store');

Route::get('order/view-edit-panel', [OrderController::class, 'viewEditPanel'])->name('order.view_Edit_Panel');

Route::get('order/view-setting', [ViewSettingController::class, 'show']);
Route::post('order/view-setting', [ViewSettingController::class, 'store']);

Route::get('order/edit-order', [OrderController::class, 'editOrder'])->name('order.edit_order');
Route::get('order/view-update-order', [OrderController::class, 'viewUpdateOrder'])->name('order.update_order');

Route::get('order/view-delete-daialog/{id}', [OrderController::class, 'viewDeleteDaialog'])->name('order.view_Delete_Daialog');
Route::post('order/validate-customer', [OrderController::class, 'validateCustomer'])->name('order.validate_customer');
Route::post('order/validate-reciver', [OrderController::class, 'validateReciver'])->name('order.validate_reciver');
Route::put('customer/updateByOrder/{id}', [CustomerController::class, 'updateByOrder'])->name('customer.updateByOrder');
Route::prefix('order/status/')->group(function () {
    Route::get('under-review', [OrderStatusController::class, 'underReview'])->name('order.under_review');
    Route::put('under-preparation/{order}', [OrderStatusController::class, 'underPreparation'])->name('order.under_preparation');
    Route::post('Receipt-from-customer/{order}', [OrderStatusController::class, 'ReceiptFromCustomer'])->name('order.Receipt_from_customer');
    Route::post('delivery-to-customer/{order}', [OrderStatusController::class, 'DeliveryToCustomer'])->name('order.delivery_to_customer');
});
Route::resource('order', OrderController::class);
