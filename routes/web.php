<?php

use App\Http\Controllers\Admin\RegisterController;
use App\Services\Orders\FetchReciverPriceFromSession;
use NotificationChannels\Telegram\Telegram;

Route::get('/', function () {
    return view('front.index');
})->name('site.index');

Route::get('/register', [RegisterController::class, 'viewRegisterPage']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/redirectToFacebook', [RegisterController::class, 'redirectToFacebook'])->name('facebook.login');

Route::get('/callback/facebook', [RegisterController::class, 'handleFacebookCallback']);
Route::get('/facebook/register', [RegisterController::class, 'viewFacebookRegister'])->name('facebook.register');
Route::post('/facebook/register', [RegisterController::class, 'FacebookRegisterProccess'])->name('facebook.register_proccess');

Route::get('/test', function () {

    return FetchReciverPriceFromSession::getPriceCharge();
    // return AlertFormatedDataJson::alertServerError('order.create');
    // delete file
    // $client->delete('/h.txt'); // path_display
    // get url for any file url
    // return Storage::disk('dropbox')->url('hellow.txt');
    // force user to download file
    //  return Storage::disk('dropbox')->files();
    //  dd($client->upload('/folder/hellow.txt','hellow'));
    //  dd($client->upload('/folder/hellow.txt','hellow'));
    //  dd($client->upload('/folder/hellow.txt','hellow'));

    //Artisan::call('backup:run');
    //   $p = app(GovernorateClass::class);
    //   $p->getAllGovernorates();
    //   $p->getFirstGovernorateWithCities();
    //return view('test.index', ['name' => 'mando']);
    //\Cache::put('key', 'value', now()->addMinutes(10));

    //return Cache::get('key');

//   dd(Telegram::class);
    //  var_dump(openssl_get_cert_locations());

    // $tele = new Telegram('1386311778:AAH375FJ6-rc161J4M799pbqrPMW42Eky8o');
    // return $tele->getMe();
    // $tele->sendContact([
    //     'chat_id' => '-1001175803813',
    //     'phone_number' => '+2001270142656',
    //     'first_name' => 'mando',
    // ]);
});
