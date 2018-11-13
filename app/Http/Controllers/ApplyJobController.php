<?php

namespace App\Http\Controllers;

use App\Classes\ApplicationService;
use App\Classes\PushNotificationService;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\NotificationRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Interfaces\JobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmailToCandidate;
use App\Jobs\SendEmailToCompany;

class ApplyJobController extends Controller
{
    protected $jobRepository;
    protected $applicationRepository;
    protected $companyRepository;
    protected $applicationService;
    protected $userRepository;
    protected $notificationRepository;
    private const RECORD_PER_PAGE = 5;
    protected $pushNotificationService;
    protected $broadCastingChannel = [
        'Application' => 'NewApplicationNotify',
    ];
    protected $events = [
        'applyjobs.store' => 'new-application'
    ];
    private const DELAY_SECONDS = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(
        JobRepository $jobRepository,
        ApplicationRepository $applicationRepository,
        CompanyRepository $companyRepository,
        ApplicationService $applicationService,
        UserRepository $userRepository,
        PushNotificationService $pushNotificationService,
        NotificationRepository $notificationRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->applicationRepository = $applicationRepository;
        $this->companyRepository = $companyRepository;
        $this->applicationService = $applicationService;
        $this->userRepository = $userRepository;
        $this->pushNotificationService = $pushNotificationService;
        $this->notificationRepository = $notificationRepository;
    }

    public function index()
    {
        $applications = $this->jobRepository->getAllApplication(Auth::id());
        $allJobs = [];
        foreach ($applications as $application) {
            $allJobs[] = $this->jobRepository->get('id', $application->job_id);
        }
        $appliedJobs = $this->jobRepository->getJobWithSkillName($allJobs);

        for ($i = 0; $i < count($applications); $i++) {
            $appliedJobs[$i]['applied_date'] = $applications[$i]->created_at->format('d/m/Y');
        }

        $jobs = $this->jobRepository->paginatorJob($appliedJobs, self::RECORD_PER_PAGE);

        return view('clients.applications.candidates.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $jobId)
    {
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
            $candidateToken = Auth::user()->token;

            //get notification json
            $notificationData = $this->notificationRepository->getNotificationDetail(
                $validatedData,
                $candidateToken,
                $jobId,
                $recentlyAddedApplication->created_at
            );


            //add notification to db
            $recentlyAddedNotification = $this->notificationRepository->createNotification($notificationData);

            //send push notification
            //assign id
            $notificationData['id'] = $recentlyAddedNotification->id;
            $this->pushNotificationService->sendNotification(
                $this->broadCastingChannel['Application'],
                $this->events['applyjobs.store'],
                json_encode($notificationData)
            );

            if ($recentlyAddedApplication) {
                try {
                    $candidate = $this->getInfoCandidate($candidateId);
                    $company = $this->getInfoCompany($jobId);
                    dispatch(new SendEmailToCandidate($candidate, $company))->delay(now()->addSeconds(Self::DELAY_SECONDS));
                    dispatch(new SendEmailToCompany($company, $candidate))->delay(now()->addSeconds(Self::DELAY_SECONDS));
                } catch (\Exception $e) {
                    return $e;
                }
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

    private function getInfoCandidate($id)
    {
        $candidate = $this->userRepository->get('id', $id);

        return $candidate;
    }

    private function getInfoCompany($id)
    {
        $data = [
            'job' => $this->jobRepository->get('id', $id),
            'company' => $this->jobRepository->get('id', $id)->user,
        ];

        return $data;
    }
}
