<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->redirectTo = route('dashboard.index');
        // مدخلش الادمن هنا لو هو مسجل دخول
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function username()
    {
        return 'user_name';
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }

}
