<?php

use App\Models\CustomerInfo;
use App\Models\Governorate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('site.index');
// })->name('home.index');

//  Auth::routes();

Route::get('/home', function () {
    return dd('23456');
})->name('site.index');

Route::get('/city', function () {
    // $c = [];
    // foreach (config('cities') as $array) {

    //     $c[] = [
    //         'id'            => $array[0],
    //         'gov_id'        => $array[1],
    //         'city_name'     => $array[2],
    //         'city_name_en'  => $array[3]
    //     ];
    // }
    // return $c;

   // return config('cities');

  //    return ( new CustomerInfo)->getTable();

  return Governorate::with('cities')->first();
});
