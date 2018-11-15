<?php

namespace App\Repositories\Eloquents;

use App\Models\Job;
use App\Repositories\Interfaces\ApplicationRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\JobRepository;
use App\Repositories\Interfaces\JobSkillRepository;
use App\Repositories\Interfaces\JobTypeRepository;
use App\Repositories\Interfaces\LocationRepository;
use App\Repositories\Interfaces\RoleRepository;
use App\Repositories\Interfaces\SkillRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Interfaces\JobCategoryRepository;
use App\Repositories\Interfaces\BookMarkRepository;
use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;


class DbJobRepository extends DbBaseRepository implements JobRepository
{
    protected $model;
    protected $jobSkillRepository;
    protected $companyRepository;
    protected $skill;
    protected $jobType;
    protected $user;
    protected $jobCategory;
    protected $applicationRepository;
    protected $role;
    protected $bookMarkRepository;
    protected $locationRepository;
    private const FORMAT_DATE = 'Y-m-d';
    private const JOB_EXIST = 1;
    private const JOB_DOSENT_EXIST = 0;
    /**
     * @param Job $model
     *
     */
    function __construct(
        Job $model,
        JobSkillRepository $jobSkillRepository,
        CompanyRepository $companyRepository,
        SkillRepository $skillRepository,
        JobTypeRepository $jobTypeRepository,
        UserRepository $userRepository,
        JobCategoryRepository $jobCategoryRepository,
        ApplicationRepository $applicationRepository,
        RoleRepository $roleRepository,
        BookMarkRepository $bookMarkRepository,
        LocationRepository $locationRepository
    ) {
        $this->model = $model;
        $this->jobSkillRepository = $jobSkillRepository;
        $this->companyRepository = $companyRepository;
        $this->skill = $skillRepository;
        $this->jobType = $jobTypeRepository;
        $this->user = $userRepository;
        $this->jobCategory = $jobCategoryRepository;
        $this->applicationRepository = $applicationRepository;
        $this->role = $roleRepository;
        $this->bookMarkRepository = $bookMarkRepository;
        $this->locationRepository = $locationRepository;
    }

    public function getAll($per)
    {
        $jobs = $this->model::with('locationJobs', 'jobTypeJobs')->get();

        return $this->paginatorJob($this->getJobWithSkillName($jobs), $per);
    }

    public function paginatorJob($listJob, $per, $url = null)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($listJob);
        $perPage = $per;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        if ($url) {
            $paginatedItems->withPath($url);
        }

        return $paginatedItems;
    }

    public function create($param)
    {
        return $this->baseCreate($param);
    }

    public function get($key, $value)
    {
        return $this->model::with('locationJobs', 'jobTypeJobs', 'applications', 'userJob')
            ->where($key, $value)->first();
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }

    public function updateJobStatus(int $jobId)
    {
        $job = $this->model::findOrFail($jobId);
        $job->is_available = $job->is_available == config('app.job_open_status') ? config('app.job_close_status') : config('app.job_open_status');
        $job->save();
    }

    public function delete($key, $value)
    {
        return $this->baseDestroy($key, $value);
    }

    public function getAllJobByCompany(int $companyId, int $per)
    {
        $jobs = Cache::rememberForever('getAllJobByCompany' . $companyId, function () use ($companyId) {
            return $this->model::where('user_id', $companyId)->with('locationJobs', 'jobTypeJobs')->get();
        });

        return $this->getJobWithSkillName($jobs);
    }

    public function getJobWithSkillName($jobs)
    {
        $authenticatedUser = Auth::user();
        $isUserAuthenticated = Auth::check();
        $roleName = $isUserAuthenticated ? $this->role->getRoleNameById($authenticatedUser->role_id) : config('app.guest_role');
        $jobsWithSkill = [];
        foreach ($jobs as $job) {
            $skillName = [];
            $skills = $this->jobSkillRepository->findAllByJobId($job->id);
            if ($skills) {
                foreach ($skills as $skill) {
                    $skillName[] = $this->skill->getNameSkillById($skill);
                }
            }
            $companyUserInfo = $this->user->getInformationCompanyByUserId($job->user_id);
            if (!empty($companyUserInfo)) {
                $jobsWithSkill[] = [
                    'job' => $job,
                    'skills' => $skillName,
                    'company_name' => $companyUserInfo['name'],
                    'company_logo' => $companyUserInfo['company_logo'],
                    'token' => $companyUserInfo['token'],
                    'role_name' => $roleName,
                    'location' => $this->locationRepository->getNameById($job->location_id),
                    'jobType' => $this->jobType->getNameById($job->job_type_id),
                    'can_apply' => $isUserAuthenticated && $roleName == config('app.candidate_role') ? $this->applicationRepository->checkDuplicate($authenticatedUser->id,
                        $job->id) : true,
                ];
            }
        }

        return array_reverse($jobsWithSkill);
    }

    public function getAllJob($key, $value)
    {
        return $this->model::with('locationJobs', 'applications', 'userJob')->where($key, $value)->orderBy('id',
            'desc')->get();
    }

    public function getJobByUser($key, $value)
    {
        return $this->baseFindAllBy($key, $value);
    }

    public function searchJob($keyword, $location, $per, $url)
    {
        $listJobId = [];
        $listJob = [];
        if ($keyword) {
            //tim kiem theo skill
            $skillSearch = $this->skill->searchSkillByName($keyword);
            if ($skillSearch) {
                $jobSkills = $this->jobSkillRepository->findAllJobBySkill($skillSearch);
                foreach ($jobSkills as $jobSkill) {
                    if (!in_array($jobSkill, $listJobId)) {
                        $listJobId[] = $jobSkill;
                    }
                }

            }
            //tim kiem theo job_type
            $jobTypeSearch = $this->jobType->searchJobTypeByName($keyword);
            if ($jobTypeSearch) {
                $jobs = $this->model->whereIn('job_type_id', $jobTypeSearch)->get(['id']);
                foreach ($jobs as $job) {
                    if (!in_array($job->id, $listJobId)) {
                        $listJobId[] = $job->id;
                    }
                }
            }
            //tim kiem theo company
            $companies = $this->user->searchCompanyByName($keyword);
            if ($companies) {
                $jobCompanies = $this->model->whereIn('user_id', $companies)->get(['id']);
                foreach ($jobCompanies as $jobCompany) {
                    if (!in_array($jobCompany->id, $listJobId)) {
                        $listJobId[] = $jobCompany->id;
                    }
                }
            }

            //tim kiem theo tite job
            $jobTitles = $this->model->where('title', 'like', '%' . $keyword . '%')->get(['id']);
            if ($jobTitles) {
                foreach ($jobTitles as $jobTitle) {
                    if (!in_array($jobTitle->id, $listJobId)) {
                        $listJobId[] = $jobTitle->id;
                    }
                }
            }
        }
        //tim kiem theo location
        if ($location && $keyword) {
            $jobs = $this->model->whereIn('id', $listJobId)->where('location_id', $location)->get(['id']);
            if ($jobs) {
                foreach ($jobs as $job) {
                    if (!in_array($job->id, $listJob)) {
                        $listJob[] = $job->id;
                    }
                }
            }
        } elseif ($location && !$keyword) {
            $activeJobs = $this->model->where('location_id', $location)->get(['id']);
            if ($activeJobs) {
                foreach ($activeJobs as $activeJob) {
                    $listJob[] = $activeJob->id;
                }
            }
        } elseif(!$location && $keyword) {
            $listJob = $listJobId;
        } else {
            $jobs = $this->model->all(['id']);
            if ($jobs) {
                foreach ($jobs as $job) {
                    $listJob[] = $job->id;
                }
            }
        }

        return $this->getJobByDate($listJob, $per, $url);
    }

    private function getJobByDate($jobs, $per, $url)
    {
        $listJobs = [];
        $company_available = $this->getAllActiveCompany();
        if ($jobs) {
            $listJobs = $this->model->where('out_date', '>=', date(self::FORMAT_DATE))
                ->where('is_available', config('app.job_open_status'))
                ->whereIn('user_id', $company_available)
                ->whereIn('id', $jobs)->get();
        }

        return $this->paginatorJob($this->getJobWithSkillName($listJobs), $per, $url);
    }

    private function compareDateJob($outDate)
    {
        $dateCurrent = strtotime(date(self::FORMAT_DATE));
        $outDate = strtotime($outDate);
        if ($outDate >= $dateCurrent) {
            return true;
        }

        return false;
    }

    public function getJobByCategory($categoryIds)
    {
        $listJobs = [];
        if ($categoryIds) {
            $i = 0;
            foreach ($categoryIds as $categoryId) {
                $i++;
                $jobIds = $this->jobCategory->getJobIdByCategory($categoryId);
                if ($i == 1) {
                    if ($jobIds) {
                        foreach ($jobIds as $jobId) {
                            $listJobs[] = $jobId;
                        }
                    }
                } else {
                    $listJobs = $this->getJobByArray($listJobs, $jobIds);
                    if ($listJobs) {
                        foreach ($listJobs as $listJob) {
                            if (!in_array($listJob, $listJobs)) {
                                $listJobs[] = $listJob;
                            }
                        }
                    }
                }
            }
        } else {
            return null;
        }

        return $listJobs;
    }

    public function getJobBySalary($salary)
    {
        if ($salary) {
            if (array_key_exists($salary[0], config('app.ListSalary'))) {
                $listArray = [];
                $salaryConvert = explode('.', $salary[0]);
                if ($salaryConvert[0] === 'F') {
                    $jobsForSalaries = $this->model->where('salary_min', '>=', (int)$salaryConvert[1])->get(['id']);

                } else {
                    $jobsForSalaries = $this->model->whereBetween('salary_min',
                        [(int)$salaryConvert[0], (int)$salaryConvert[1]])->get(['id']);
                }
                foreach ($jobsForSalaries as $jobsForSalary) {
                    $listArray[] = $jobsForSalary->id;
                }

                return $listArray;
            }
        }

        return null;
    }

    public function getJobBySalaryCategory($salary, $categoryId, $per, $url)
    {
        $jobs = null;
        if ($salary && $categoryId) {
            $jobs = $this->getJobByArray($this->getJobBySalary($salary), $this->getJobByCategory($categoryId));
        } elseif ($salary) {
            $jobs = $this->getJobBySalary($salary);
        } elseif ($categoryId) {
            $jobs = $this->getJobByCategory($categoryId);
        } else {
            $jobs = [];
            $allJobs = $this->model->get(['id']);
            foreach ($allJobs as $allJob) {
                $jobs[] = $allJob->id;
            }
        }

        return $this->getJobByDate($jobs, $per, $url);
    }

    public function getJobByArray($arrayJobBefore, $arrayJobAfter)
    {
        if (!empty($arrayJobBefore) && !empty($arrayJobAfter)) {
            return array_intersect($arrayJobBefore, $arrayJobAfter);
        }

        return null;
    }

    public function getAllApplication(int $userId)
    {
        $applications = $this->applicationRepository->getAllAppliedJobByUser($userId);

        return $applications;
    }

    public function getLatestJobs(int $companyId)
    {
        return $this->model::where('user_id', $companyId)
            ->orderBy('created_at', 'desc')
            ->take(config('app.record_number'))->get();
    }

    public function getAllAvailableJob(int $recordPerPage, $userIds, $url = null)
    {
        $bookMarks = null;
        $jobIds = null;
        $checkJob = self::JOB_DOSENT_EXIST;
        $userId = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $bookMarks = $this->bookMarkRepository->getBookMarkByUser('user_id', $userId);
            if (!empty($bookMarks->toArray())) {
                $jobIds = $this->jobCategory->getJobByCategoryId('category_id', $bookMarks);
                if (!empty($jobIds->toArray())) {
                    $checkJob = self::JOB_EXIST;
                }
            }
        }

        if ($checkJob == self::JOB_EXIST) {
            $getJobs = Cache::rememberForever('getAllAvailableJobByBookMarks' . $userId, function () use ($userIds, $jobIds) {
                return $this->model::where('is_available', config('app.job_open_status'))
                    ->where('out_date', '>=', date(self::FORMAT_DATE))
                    ->whereIn('user_id', $userIds)
                    ->whereIn('id', $jobIds->toArray())
                    ->get();
            });
        } else {
            $getJobs = Cache::rememberForever('getAllAvailableJob', function () use ($userIds) {
                return $this->model::where('is_available', config('app.job_open_status'))
                    ->where('out_date', '>=', date(self::FORMAT_DATE))
                    ->whereIn('user_id', $userIds)
                    ->get();
            });
        }

        return $this->paginatorJob($this->getJobWithSkillName($getJobs), $recordPerPage, $url);
    }

    public function getAllActiveCompany()
    {
        $roleId = $this->role->getRoleIdByName(config('app.company_role'));
        $companies = $this->user->getCompanyByStatus(config('app.status_account_activate'), $roleId, ['id']);
        $companyIds = [];
        if ($companies) {
            foreach ($companies as $company) {
                $companyIds[] = $company->id;
            }
        }

        return $companyIds;
    }
}
