<?php

use App\Models\City;

use App\Models\User;
use App\Models\Admin;
use App\Events\MyEvent;
use App\TestFolder\TestClass;
use Nexmo\Laravel\Facade\Nexmo;
use App\DryClasses\GovernorateClass;
use App\Notifications\AddedNewOrder;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\Telegram\Telegram;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Admin\RegisterController;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

Route::get('/', function () {
    return view('front.index');
})->name('site.index');

Route::get('/register' , [RegisterController::class , 'viewRegisterPage']);
Route::post('/register' , [RegisterController::class , 'register'])->name('register');
Route::get('/redirectToFacebook' , [RegisterController::class , 'redirectToFacebook'])->name('facebook.login');

Route::get('/callback/facebook' , [RegisterController::class , 'handleFacebookCallback']);
Route::get('/facebook/register' , [RegisterController::class , 'viewFacebookRegister'])->name('facebook.register');
Route::post('/facebook/register' , [RegisterController::class , 'FacebookRegisterProccess'])->name('facebook.register_proccess');


Route::get('/test', function(){

//   $p = app(GovernorateClass::class);
//   $p->getAllGovernorates();
//   $p->getFirstGovernorateWithCities();
 //return view('test.index', ['name' => 'mando']);
//\Cache::put('key', 'value', now()->addMinutes(10));

 //return Cache::get('key');

//   dd(Telegram::class);
   $tele = new Telegram('1386311778:AAH375FJ6-rc161J4M799pbqrPMW42Eky8o');
        $tele->sendMessage([
            'chat_id' => '-1001175803813',
            'text' => 'test #error',
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => '',
            'disable_notification' => '',
            'reply_to_message_id' => '{info:mando}',
            'reply_markup' => '',
            'caption' => 'caption',
            'entities' => '#error'
        ]);
    Nexmo::message()->send([
      'to'   => '+2001279728519',
      'from' => '+2001270142656',
      'text' => 'Using the facade to send a message.'
  ]);

  //Admin::find(auth('admin')->id())->notify(new AddedNewOrder());
//   Notification::send(
//     [
//     auth('admin')->user(),
//     Admin::find(2)
//     ] , new AddedNewOrder(
//         [
//             'user'=>1,
//             'name' =>'admin'
//         ]
//     ));

});
