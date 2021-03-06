<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo;
    protected $passwordError = false;
    protected $identifyError = false;

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
        return 'identify';
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function attemptLogin(Request $request)
    {
        try {
            $remmber_me = $request->remmber_me ? true : false;
            $admin = Admin::where(function ($query) use ($request) {
                $query->where('user_name', $request->identify)
                    ->orWhere('phone', $request->identify)
                    ->orWhere('email', $request->identify);
            })->first();

            if ($admin) {
                if (Hash::check($request->password, $admin->getPassword())) {
                    // login this admin
                    return Auth::guard('admin')->login($admin, $remmber_me);
                } else {
                    $this->passwordError = true;
                }
            } else {
                $this->identifyError = true;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $response = $this->loggedOut($request);
        if ($response) {
            return $response;
        }

        return $request->wantsJson()
        ? new Response('', 204)
        : redirect('/admin/login');
    }
    protected function sendFailedLoginResponse()
    {
        $errors = [];
        $this->identifyError === true ? $errors['identify'] = trans('auth.failed') : false;
        $this->passwordError === true ? $errors['password'] = trans('auth.password') : false;

        throw ValidationException::withMessages($errors);
    }
}
