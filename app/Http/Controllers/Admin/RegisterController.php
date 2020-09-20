<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    public function viewRegisterPage()
    {
         return view('register.register');
    }

    public function register()
    {

    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

         return $user;
    }
}
