<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Interfaces\CandidateRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\RoleRepository;
use DB;
use Uuid;
use App\Jobs\SendEmailConfirmAccounts;
use App\Http\Requests\CreateAccountRequest;
use Cache;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $userRepository;
    protected $candidateRepository;
    protected $companyRepository;
    protected $roleRepository;
    protected const IMG_USER_DEFAULT = 'user.png';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepository $userRepository,
        CompanyRepository $companyRepository,
        CandidateRepository $candidateRepository,
        RoleRepository $roleRepository
    ) {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->candidateRepository = $candidateRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(CreateAccountRequest $request)
    {
        $data = $request->toArray();
        $register = DB::transaction(function () use ($data) {
            try {
                $data['password'] = Hash::make($data['password']);
                $data['status'] = config('app.status_account_deactivate');
                $data['token'] = Uuid::generate()->string;
                $data['role_id'] = $this->roleRepository->get('name', $data['role_name'])->id;
                $user = $this->userRepository->create($data);
                $data['user_id'] = $user->id;
                $data['logo_url'] = self::IMG_USER_DEFAULT;
                $data['avatar_url'] = self::IMG_USER_DEFAULT;
                if ($data['role_name'] == config('app.candidate_role')) {
                    $candidate = $this->candidateRepository->create($data);
                } else {
                    $company = $this->companyRepository->create($data);
                    if ($company) {
                        $cacheCompanyKey = 'getInformationCompanyByUserId' . $company->id;
                        if (Cache::has($cacheCompanyKey)) {
                            Cache::pull($cacheCompanyKey);
                        }
                    }
                }

                $sendmail = dispatch(new SendEmailConfirmAccounts($data))->delay(now()->addSeconds(10));

                DB::commit();

                if ($sendmail) {
                    $message = __('Register success! Please check your email and confirm account!');
                } else {
                    $message = __('Register failed. Please try again!');
                }

                return view('auth.notifications')->with('msg', $message);
            } catch (\Exception $e) {
                DB::rollback();

                return $e;
            }
        });

        return $register;
    }

    public function confirmAccount($token)
    {
        if (Auth::check()) {
            Auth::logout();
        }
        $user = $this->userRepository->get('token', $token);
        if ($user->status != config('app.status_account_activate')) {
            $message ='';
            if ($user->userRole->name == config('app.company_role')) {
                $user->status = config('app.status_account_waiting_approve');
                $message = __('Confirm account successfully! Please contact admin to activate your account');
            } elseif ($user->userRole->name == config('app.candidate_role')) {
                $user->status = config('app.status_account_activate');
                $this->removeCache('getAllCandidate');
                $message = __('Confirm account successfully! You can sign in now.');
            }

            $updateUser = $this->userRepository->update($user->toArray(), 'token', $token);
            if ($updateUser) {
                return view('auth.notifications')->with('msg', $message);
            }
        }

        return redirect()->route('home.index');
    }
}
