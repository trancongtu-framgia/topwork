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

    public function showLoginForm()
    {
        session(['previousUrl' => url()->previous()]);

        return view('auth.login');
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
            $authenticatedUser = Auth::user();
            $role = strtolower($authenticatedUser->userRole->name);
            if ($role == config('app.admin_role')) {
                session(['authenticated_user' => $authenticatedUser->token]);

                return redirect()->route('admin.index');
            }

            return $this->authenticated($request, Auth::user());
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        session(['authenticated_user' => $user->token]);

        return redirect(session()->pull('previousUrl'));
    }
}
