<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\JobCategoryRepository;
use App\Repositories\Interfaces\JobRepository;
use App\Repositories\Interfaces\JobSkillRepository;
use App\Repositories\Interfaces\JobTypeRepository;
use App\Repositories\Interfaces\LocationRepository;
use App\Repositories\Interfaces\SkillRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Interfaces\ApplicationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    private const RECORD_PER_PAGE = 10;
    private $jobRepository;
    private $categoryRepository;
    private $skillRepository;
    private $jobCategoryRepository;
    private $jobTypeRepository;
    private $jobSkillRepository;
    private $locationRepository;
    private $userRepository;
    private $companyRepository;
    private $applicationRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(
        JobRepository $jobRepository,
        CategoryRepository $categoryRepository,
        SkillRepository $skillRepository,
        JobCategoryRepository $jobCategoryRepository,
        JobTypeRepository $jobTypeRepository,
        JobSkillRepository $jobSkillRepository,
        LocationRepository $locationRepository,
        UserRepository $userRepository,
        CompanyRepository $companyRepository,
        ApplicationRepository $applicationRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->categoryRepository = $categoryRepository;
        $this->skillRepository = $skillRepository;
        $this->jobCategoryRepository = $jobCategoryRepository;
        $this->jobTypeRepository = $jobTypeRepository;
        $this->jobSkillRepository = $jobSkillRepository;
        $this->locationRepository = $locationRepository;
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->applicationRepository = $applicationRepository;
    }

    public function index()
    {
        $companyId = Auth::id();
        $postedJobs = $this->jobRepository->getAllJobByCompany($companyId, self::RECORD_PER_PAGE);
        $jobs = $this->jobRepository->paginatorJob($postedJobs, self::RECORD_PER_PAGE);

        return view('clients.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAllWithOutPaginate()->toArray();
        $jobTypes = $this->jobTypeRepository->getAllWithOutPaginate()->toArray();
        $locations = $this->locationRepository->getAllWithOutPaginate()->toArray();
        $skills = $this->skillRepository->getAllWithOutPaginate()->toArray();

        return view('clients.jobs.create', compact('categories', 'jobTypes', 'locations', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $validatedJobData = $request->except(['category_id', 'job_skill_ids']);
        $validatedJobData['user_id'] = Auth::id();
        $recentlyAddedJob = $this->jobRepository->create($validatedJobData)->id;

        $skillArray = $request->validated()['job_skill_ids'];
        $categoryArray = $request->validated()['category_ids'];

        $this->jobCategoryRepository->createByJobId($recentlyAddedJob, $categoryArray);
        $this->jobSkillRepository->createByJobId($recentlyAddedJob, $skillArray);

        if ($recentlyAddedJob) {
            flash(__('Add successfully'))->success();

            return redirect()->route('jobs.index');
        } else {
            flash(__('Add fail'))->error();

            return redirect()->route('jobs.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(int $jobId)
    {
        $job = $this->jobRepository->get('id', $jobId);
        $company = $this->companyRepository->get('user_id', $job->user_id);
        $jobDetail = $this->jobRepository->getJobWithSkillName(new Collection([$job]))[0];

        return view('clients.jobs.detail', compact('jobDetail', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $jobId)
    {
        $recentlyDeletedJob = $this->jobRepository->delete('id', $jobId);
        if ($recentlyDeletedJob) {
            flash(__('Delete successfully'))->success();
            $this->jobSkillRepository->delete('job_id', $jobId);
            $this->jobCategoryRepository->delete('job_id', $jobId);

            return redirect()->route('jobs.index');
        } else {
            flash(__('Delete fail'))->error();

            return redirect()->route('jobs.index');
        }
    }

    public function getJobByCategory(Request $request)
    {
        $jobs = $this->jobRepository->getJobByCategory($request->categoryId, self::RECORD_PER_PAGE, $request->fullUrl());

        return view('clients.home.jobContentSearchByCategory', compact('jobs'));
    }
}
