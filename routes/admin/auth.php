<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Models\Admin;

Route::get('addadmin', function () {

    $admin = new Admin();
    $admin->name = "admin";
    $admin->password = bcrypt('123456');
    $admin->fullname = "admin";
    $admin->role_id = 1;
    $admin->save();
    return $admin;
});
Route::get('lang/{language}',[LanguageController::class,'langChange'])->name('lang.change');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('login',  'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login.post');

    Route::get('logout', 'LoginController@logout')->name('logout');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
});