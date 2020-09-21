<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\LanguageController;

Route::get('lang/{language}', [LanguageController::class, 'langChange'])->name('lang.change');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login.post');

    Route::get('logout', 'LoginController@logout')->name('logout');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
});
