<?php

namespace App\Http\Controllers;

use App\Classes\ApplicationService;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\JobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    protected $jobRepository;
    protected $applicationRepository;
    protected $companyRepository;
    protected $applicationService;
    protected const PER_PAGE = 5;

    public function __construct(
        ApplicationRepository $applicationRepository,
        JobRepository $jobRepository,
        CompanyRepository $companyRepository,
        ApplicationService $applicationService
    ) {
        $this->applicationRepository = $applicationRepository;
        $this->jobRepository = $jobRepository;
        $this->companyRepository = $companyRepository;
        $this->applicationService = $applicationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $jobId)
    {
        $user = Auth::user();
        $job = $this->jobRepository->get('id', $jobId);
        $companyName = $this->companyRepository->getCompanyName($job->user_id);
        $canApply = $this->applicationRepository->checkDuplicate($user->id, $jobId);

        return view('clients.applications.create', compact('job', 'companyName', 'user', 'canApply'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(ApplicationRequest $request)
    {
        $candidateId = Auth::id();
        $validatedData = $request->validated();
        $jobId = $validatedData['job_id'];

        if ($this->applicationRepository->checkDuplicate($candidateId, $jobId)) {
            $validatedData['user_id'] = $candidateId;
            $uploadedCv = $validatedData['cv_url'];
            $cvUrl = $this->applicationService->handleUploadedCv($uploadedCv);
            $validatedData['cv_url'] = $cvUrl;
            $validatedData['status'] = config('app.job_application_new_status');
            $recentlyAddedApplication = $this->applicationRepository->create($validatedData);

            if ($recentlyAddedApplication) {
                return redirect()->route('jobs.detail', ['id' => $jobId])
                    ->with('status', __('Job applied'));
            } else {
                return redirect()->route('jobs.detail', ['id' => $jobId])
                    ->with('status', __('Apply failed'));
            }
        } else {
            return redirect()->route('jobs.detail', ['id' => $jobId])
                ->with('status', __('You have applied this job'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }

    public function getListCandidateApplication(string $id)
    {
        $jobs = $this->jobRepository->getAllJob('user_id', $id, self::PER_PAGE);

        return view('clients.applications.index', compact('jobs'));
    }

    public function getCandidateByJob($value)
    {
        if (!empty($value)) {
            $jobArr = [];
            $jobIds = explode(',', $value);
            foreach ($jobIds as $jobId) {
                $job = $this->jobRepository->get('id', $jobId);
                $jobArr[] = $job;
            }

            return view('clients.applications.ajax', compact('jobArr'));
        }
    }

    public function getCandidateByUser($id)
    {
        $jobs = $this->jobRepository->getJobByUser('user_id', $id);
        $jobArr = [];
        foreach ($jobs as $key => $job) {
            $jobArr[] = $job;
        }

        return view('clients.applications.ajax', compact('jobArr'));
    }
}
