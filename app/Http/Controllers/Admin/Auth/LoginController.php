<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Login;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

            $admin = Admin::where(function ($query) use ($request) {
                $query->where('user_name', $request->identify)
                    ->orWhere('phone', $request->identify)
                    ->orWhere('email', $request->identify);
            })->first();

            if ($admin) {

                if (Hash::check($request->password, $admin->getPassword())) {
                    // login this admin
                    return Auth::guard('admin')->login($admin ,1);
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

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/admin/login');
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [];
        $this->identifyError === true ? $errors['identify'] = trans('auth.failed') : false;
        $this->passwordError === true ? $errors['password'] = trans('auth.password') : false;

        throw ValidationException::withMessages($errors);
    }
}
