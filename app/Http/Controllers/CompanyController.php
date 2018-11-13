<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\JobRepository;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateCompanyRequest;
use Cache;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $company;
    protected $userRepository;
    protected $jobRepository;

    function __construct(CompanyRepository $companyRepository, UserRepository $userRepository, JobRepository $jobRepository)
    {
        $this->userRepository = $userRepository;
        $this->company = $companyRepository;
        $this->jobRepository = $jobRepository;
    }

    public function index()
    {
        $userId = $this->userRepository->getSpecifiedColumn('token', Auth::user()->token, ['id'])->id;
        $company = $this->company->getProfile($userId);

        return view('clients.companies.index', compact('company'));
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(string $token)
    {
        try {
            $userId = $this->userRepository->get('token', $token)->id;
            $company = $this->company->getProfile($userId);
            $relatedJobs = $this->jobRepository->getJobWithSkillName($this->jobRepository->getLatestJobs($userId));
        } catch (\Exception $e) {
            return redirect()->route('home.index');
        }

        return view('clients.companies.index', compact('company', 'relatedJobs'));
    }

    public function edit()
    {
        $company = $this->company->get('user_id', Auth::id());

        return view('clients.companies.update', ['company' => $company]);
    }

    public function update(UpdateCompanyRequest $request, $companyId)
    {
        $company = $this->company->updateInfoCompany($request, $companyId);
        $cacheCompanyKey = 'getInformationCompanyByUserId' . $companyId;
        if ($company) {
            if (Cache::has($cacheCompanyKey)) {
                Cache::pull($cacheCompanyKey);
            }
            flash(__('Edit Profile Success'))->success();

            return redirect()->route('companies.index');
        } else {
            flash(__('Edit Profile Failed, Please try again!'))->error();

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
