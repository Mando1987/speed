<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FacebookRegisterFormRequest;
use App\Services\Registers\FacebookRegisterService;
use Laravel\Socialite\Facades\Socialite;
use Str;

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
        $url = request()->url();
        //site in local
        if(Str::contains($url, 'speed.test')){
            session(['facebook' => [
                'fullname' => 'customer',
                'email'    => 'customer@test.com',
                'image'    => 'default.png',
           ]]);
           return redirect()->route('facebook.register');
        }
        return Socialite::driver('facebook')->with(['access_token' => 'd43b2a56bad09abac57b7b937501b50f'])->redirect();
    }

    public function handleFacebookCallback()
    {
        if(session()->has('facebook')){
            return redirect()->route('facebook.register');
        }
        $user = Socialite::driver('facebook')->user();
        $data = [
            'fullname' => $user->getName(),
            'email'    => $user->getEmail(),
            'image'    => $user->getAvatar(),
        ];

        session(['facebook' => $data]);
        return redirect()->route('facebook.register');
    }

    public function viewFacebookRegister()
    {
        return view('register.facebook-register' , ['data' => session('facebook')]);
    }

    public function FacebookRegisterProccess(FacebookRegisterFormRequest $request)
    {
       return app(FacebookRegisterService::class)->store($request);
    }
}
