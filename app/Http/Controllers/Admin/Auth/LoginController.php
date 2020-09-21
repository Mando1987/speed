<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->redirectTo = route('dashboard.index');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function username()
    {

        $value = request('user_name');

        $colmun = filter_var($value , FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        request()->merge([$colmun => $value]);

        return $colmun;

    }
    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.' . $this->username())],
        ]);
    }
}
