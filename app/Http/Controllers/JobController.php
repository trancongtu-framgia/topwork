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
    private $jobCategory;

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
        ApplicationRepository $applicationRepository,
        JobCategoryRepository $JobCategoryRepository
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
        $this->jobCategory = $JobCategoryRepository;
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
        $skills = [];
        $jobSkills = [];
        $jobCategory = [];

        return view('clients.jobs.create',
            compact('categories', 'jobTypes', 'locations', 'skills', 'jobCategory', 'jobSkills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $validatedJobData = $request->except([
            'category_id',
            'job_skill_ids',
        ]);
        $validatedJobData['user_id'] = Auth::id();
        $validatedJobData['is_available'] = $validatedJobData['is_available'] == null ? config('app.job_close_status') : config('app.job_open_status');
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
     * @param  \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function show(int $jobId)
    {
        try {
            $job = $this->jobRepository->get('id', $jobId);
            $company = $this->companyRepository->get('user_id', $job->user_id);
            $jobDetail = $this->jobRepository->getJobWithSkillName(new Collection([$job]))[0];

            return view('clients.jobs.detail', compact('jobDetail', 'company'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = $this->jobRepository->get('id', $id);
        $authenticatedCompanyUser = Auth::user();
        if ($authenticatedCompanyUser->can('edit', $job)) {
            $categories = $this->categoryRepository->getAllWithOutPaginate()->toArray();
            $jobTypes = $this->jobTypeRepository->getAllWithOutPaginate()->toArray();
            $locations = $this->locationRepository->getAllWithOutPaginate()->toArray();
            $jobCategory = [];
            $listJobCategory = $this->jobCategory->getCategoryByJobId($id);
            if ($listJobCategory) {
                $jobCategory = $listJobCategory;
            }
            $skills = $this->skillRepository->getSkillByCategory($listJobCategory);
            $skillJobs = $this->jobSkillRepository->getSkillByJobId($id);

            return view('clients.jobs.update',
                compact('categories', 'jobTypes', 'locations', 'skills', 'job', 'jobCategory', 'skillJobs'));
        }

        abort(403, __('Unauthorized action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $id)
    {
        $authenticatedCompanyUser = Auth::user();
        $job = $this->jobRepository->get('id', $id);
        if ($authenticatedCompanyUser->can('edit', $job)) {
            $validatedJobData = $request->validated();
            $validatedJobData['is_available'] = $validatedJobData['is_available'] == null ? config('app.job_close_status') : config('app.job_open_status');

            $jobs = $this->jobRepository->update($validatedJobData, 'id', $id);
            $this->jobCategory->delete('job_id', $id);
            $this->jobSkillRepository->delete('job_id', $id);

            $skillArray = $request->validated()['job_skill_ids'];
            $categoryArray = $request->validated()['category_ids'];

            $this->jobCategoryRepository->createByJobId($id, $categoryArray);
            $this->jobSkillRepository->createByJobId($id, $skillArray);

            if ($jobs) {
                flash(__('Update role success'))->success();
            } else {
                flash(__('Update role failed, Please try again'))->error();
            }

            return redirect()->route('jobs.index');
        }

        abort(403, __('Unauthorized action'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $jobId)
    {
        $authenticatedCompanyUser = Auth::user();
        $job = $this->jobRepository->get('id', $jobId);
        if ($authenticatedCompanyUser->can('delete', $job)) {
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

        abort(403);
    }


    public function changeJobStatus(Request $request)
    {
        $updatedJob = $this->jobRepository->updateJobStatus($request->id);

        return response()->json('ok');
    }


    public function getJobBySalaryCategory(Request $request)
    {
        $jobs = $this->jobRepository->getJobBySalaryCategory($request->salary, $request->categoryId,
            self::RECORD_PER_PAGE, $request->fullUrl());
        if ($jobs) {
            return view('clients.home.partials.contentShowJobs', compact('jobs'));
        }

        return __('No results were found');
    }
}
