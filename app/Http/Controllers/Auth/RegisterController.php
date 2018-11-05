<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
                if ($data['role_name'] == config('app.candidate_role')) {
                    $candidate = $this->candidateRepository->create($data);
                } else {
                    $company = $this->companyRepository->create($data);
                }

                dispatch(new SendEmailConfirmAccounts($data));
                DB::commit();

                if ($candidate || $company) {
                    flash(__('Register succes. Please check email and confirm account!'))->success();

                    
                    return redirect()->route('login');
                } else {
                    flash(__('Register failed. Please try again!'));

                    return redirect()->back();
                }
            } catch (\Exception $e) {
                DB::rollback();

                return $e;
            }
        });

        return $register;
    }

    public function confirmAccount($idUser)
    {
        $user = $this->userRepository->get('id', $idUser);
        $user->status = config('app.status_account_activate');
        $updateUser = $this->userRepository->update($user->toArray(), 'id', $idUser);
        if ($updateUser) {
            flash('Confirm account success!')->success();

            return redirect()->route('login');
        } else {
            flash('Confirm account failed! please try again!')->error();

            return redirect()->back();
        }
    }
}
