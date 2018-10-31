<?php

namespace App\Http\Controllers;

use App\Classes\ApplicationService;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\JobRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\CandidateRepository;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Exception;

class ApplicationController extends Controller
{
    protected $jobRepository;
    protected $applicationRepository;
    protected $companyRepository;
    protected $applicationService;
    protected $candidateRepository;
    protected $userRepository;
    protected const PER_PAGE = 10;

    public function __construct(
        JobRepository $jobRepository,
        ApplicationRepository $applicationRepository,
        CompanyRepository $companyRepository,
        ApplicationService $applicationService,
        CandidateRepository $candidateRepository,
        UserRepository $userRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->applicationRepository = $applicationRepository;
        $this->companyRepository = $companyRepository;
        $this->applicationService = $applicationService;
        $this->candidateRepository = $candidateRepository;
        $this->userRepository = $userRepository;
    }

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
        $canApply = $this->applicationRepository->checkDuplicate($user->id, $jobId);
        if ($canApply) {
            $job = $this->jobRepository->get('id', $jobId);
            $job = $this->jobRepository->getJobWithSkillName(new Collection([$job]))[0];

            return view('clients.applications.create', compact('job', 'user', 'canApply'));
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(ApplicationRequest $request)
    {
        //
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
    public function update(Request $request, int $id)
    {
        $application = $this->applicationRepository->update($request->toArray(), 'id', $id);

        if ($application) {
            flash(__('Update application success'))->success();
        } else {
            flash(__('Update application failed, Please try again'))->error();
        }

        return redirect()->route('application.getDetailCandidate', $request->token . '?job=' . $request->job);
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
        try {
            $jobs = $this->getJobByTokenUser($id);

            return view('clients.applications.index', compact('jobs'));
        } catch (\Exception $e) {
            return redirect()->back();
        }

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

    public function getDetailCandidateApply(Request $request, $token)
    {
        $getDetail = DB::transaction( function () use ($request, $token){
            try {
                $jobId = $request->job;
                $user = $this->candidateRepository->showInfoCandidate($token);
                $jobs = $this->jobRepository->get('id', $jobId);
                $application = $this->applicationRepository->getApplicationByUserAndJob($jobId, $user->id);
                $addChecked = $this->addChecked($application);
                DB::commit();

                return view('clients.applications.detail', compact('user', 'jobs', 'application'));
            } catch (\Exception $e) {
                DB::rollback();

                return redirect()->back();
            }
        });

        return $getDetail;
    }

    public function downloadCv($fileName)
    {
        try {
            if (file_exists(config('app.cv_base_url') . $fileName)) {
                $file = config('app.cv_base_url') . $fileName;
                $name = basename($file);

                return response()->download($file, $name);
            } else {
                throw new Exception(__('Cannot find'));
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    private function getJobByTokenUser($token)
    {
        $user = $this->userRepository->get('token', $token);
        $jobs = $this->jobRepository->getAllJob('user_id', $user->id, self::PER_PAGE);

        return $jobs;
    }

    private function addChecked($application)
    {
        $application->status = config('app.candidate_apply_checked');

        return $this->applicationRepository->update($application->toArray(), 'id', $application->id);
    }
}
