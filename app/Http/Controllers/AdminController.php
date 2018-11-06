<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\JobRepository;
use App\Repositories\Interfaces\RoleRepository;
use App\Repositories\Interfaces\UserRepository;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $companyRepository;
    private $userRepository;
    private $roleRepository;
    private $jobRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(
        CompanyRepository $companyRepository,
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        JobRepository $jobRepository
    ) {
        $this->companyRepository = $companyRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->jobRepository = $jobRepository;
    }

    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getAllCompany()
    {
        $roleId = $this->roleRepository->getSpecifiedColumn('name', config('app.company_role'), ['id'])->id;
        $companies = $this->userRepository->baseFindAllBy('role_id', $roleId);

        return view('admin.companies.index', compact('companies'));
    }

    public function getAllCompanyByStatus(int $statusCode)
    {
        $roleId = $this->roleRepository->getSpecifiedColumn('name', config('app.company_role'), ['id'])->id;
        $companies = $this->userRepository->getCompanyByStatus($statusCode, $roleId, []);

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(int $companyId)
    {
        $company = $this->companyRepository->getProfile($companyId);

        return view('admin.companies.detail', compact('company'));
    }


    public function changeCompanyStatus(int $companyId)
    {
        $currentStatus = $this->userRepository->getSpecifiedColumn('id', $companyId, ['status'])->status;
        $inversionStatus = $currentStatus == config('app.status_account_activate') ? config('app.status_account_deactivate') : config('app.status_account_activate');

        $update = $this->userRepository->update(['status' => $inversionStatus], 'id', $companyId);

        if ($update) {
            flash(__('Activate successfully'))->success();

            return redirect()->route('admin.companies.index');
        } else {
            flash(__('Deactivate fail'))->error();

            return redirect()->route('admin.companies.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
