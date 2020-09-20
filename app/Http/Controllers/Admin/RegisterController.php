<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        return Socialite::driver('facebook')->with(['access_token' => 'd43b2a56bad09abac57b7b937501b50f'])->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        return $user->token;

        $user->getId();
        $user->getNickname();
        $user->getName();
        $user->getEmail();
        $user->getAvatar();
    }
}
