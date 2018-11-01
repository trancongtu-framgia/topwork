<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';
    public const USER_STATUS = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $messages = [
            'email.required' => __('email cant blank'),
            'password.required' => __('password cant bank'),
        ];

        return $this->getValidationFactory()
            ->make($request->all(), $rules, $messages, $customAttributes)
            ->validate();
    }

    protected function login(Request $request)
    {
        $this->validateLogin($request);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => self::USER_STATUS,
        ], $request->remember)) {
            $role = strtolower(Auth::user()->userRole->name);
            if ($role == config('app.admin_role')) {
                return redirect()->route('admin.index');
            } elseif ($role == config('app.company_role')) {
                return redirect()->route('companies.index');
            } elseif ($role == config('app.candidate_role')) {
                return redirect()->route('home.index');
            }
            Auth::logout();

            return redirect()->route('login');
        }

        return $this->sendFailedLoginResponse($request);
    }
}
