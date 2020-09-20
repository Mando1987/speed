<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegisterController;


Route::get('/', function () {
    return view('front.index');
})->name('site.index');

Route::get('/register' , [RegisterController::class , 'viewRegisterPage']);
Route::post('/register' , [RegisterController::class , 'register'])->name('register');
Route::get('/redirectToFacebook' , [RegisterController::class , 'redirectToFacebook'])->name('facebook.login');

Route::get('/callback/facebook' , [RegisterController::class , 'handleFacebookCallback']);
Route::get('/facebook/register' , [RegisterController::class , 'viewFacebookRegister'])->name('facebook.register');
Route::post('/facebook/register' , [RegisterController::class , 'FacebookRegisterProccess'])->name('facebook.register_proccess');

