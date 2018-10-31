<?php

namespace App\Repositories\Eloquents;

use App\Models\Job;
use App\Repositories\Interfaces\ApplicationRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\JobRepository;
use App\Repositories\Interfaces\JobSkillRepository;
use App\Repositories\Interfaces\JobTypeRepository;
use App\Repositories\Interfaces\SkillRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Interfaces\JobCategoryRepository;
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
    private const FORMAT_DATE = 'Y-m-d';

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
        ApplicationRepository $applicationRepository
    )
    {
        $this->model = $model;
        $this->jobSkillRepository = $jobSkillRepository;
        $this->companyRepository = $companyRepository;
        $this->skill = $skillRepository;
        $this->jobType = $jobTypeRepository;
        $this->user = $userRepository;
        $this->jobCategory = $jobCategoryRepository;
        $this->applicationRepository = $applicationRepository;
    }

    public function getAll($per)
    {
        $listJob = [];
        $jobs = $this->model->all();
        if ($jobs) {
            foreach ($jobs as $job) {
                if ($this->compareDateJob($job->out_date)) {
                    $listJob[] = $job;
                }
            }
        }

        return $this->paginatorJob($this->getJobWithSkillName($listJob), $per);
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
        return $this->baseFindBy($key, $value);
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }

    public function delete($key, $value)
    {
        return $this->baseDestroy($key, $value);
    }

    public function getAllJobByCompany(int $companyId, int $per)
    {
        $jobs = $this->model::where('user_id', $companyId)->paginate($per);

        return $this->getJobWithSkillName($jobs);
    }

    public function getJobWithSkillName($jobs)
    {
        $jobsWithSkill = [];
        foreach ($jobs as $job) {
            $skillName = [];
            $skills = $this->jobSkillRepository->findAllByJobId($job->id);
            if ($skills) {
                foreach ($skills as $skill) {
                    $skillName[] = $skill->skillJobs->name;
                }
            }
            $jobsWithSkill[] = [
                'job' => $job,
                'skills' => $skillName,
                'company_name' => $this->companyRepository->getCompanyName($job->user_id),
                'company_logo' => $this->companyRepository->get('user_id', $job->user_id)->logo_url,
                'token' => $this->companyRepository->get('user_id', $job->user_id)->companyUser->token,
                'role_name' => Auth::check() ? Auth::user()->userRole->name : config('app.guest_role'),
                'can_apply' => Auth::check() ? $this->applicationRepository->checkDuplicate(Auth::id(), $job->id) : true,
            ];
        }

        return $jobsWithSkill;
    }

    public function getAllJob($key, $value, $per)
    {
        return $this->model->where($key, $value)->orderBy('id', 'desc')->paginate($per);
    }

    public function getJobByUser($key, $value)
    {
        return $this->baseFindAllBy($key, $value);
    }

    public function searchJob($keyword, $location, $per, $url)
    {
        //tim kiem theo skill
        $skillSearch = $this->skill->searchSkillByName($keyword);
        $listJobId = [];
        $listJob = [];
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
            foreach ($jobTypeSearch as $jt) {
                $jobs = $this->model->where('job_type_id', $jt->id)->get();
                foreach ($jobs as $job) {
                    if (!in_array($job->id, $listJobId)) {
                        $listJobId[] = $job->id;
                    }
                }

            }
        }
        //tim kiem theo company
        $companies = $this->user->searchCompanyByName($keyword);
        if ($companies) {
            foreach ($companies as $company) {
                $jobCompanies = $this->model->where('user_id', $company->id)->get();
                foreach ($jobCompanies as $jobCompany) {
                    if (!in_array($jobCompany->id, $listJobId)) {
                        $listJobId[] = $jobCompany->id;
                    }
                }
            }
        }
        //tim kiem theo tite job
        $jobTitles = $this->model->where('title', 'like', '%' . $keyword . '%')->get();
        if ($jobTitles) {
            foreach ($jobTitles as $jobTitle) {
                if (!in_array($jobTitle->id, $listJobId)) {
                    $listJobId[] = $jobTitle->id;
                }
            }
        }
        //tim kiem theo location
        if (isset($location) && !empty($listJobId)) {
            foreach ($listJobId as $ljd) {
                $activeJobs = $this->model->where(['id' => $ljd, 'location_id' => $location])->first();
                if ($activeJobs) {
                    if (!in_array($activeJobs->id, $listJob)) {
                        $listJob[] = $activeJobs->id;
                    }
                }
            }
        } elseif ($location) {
            $activeJobs = $this->model->where('location_id', $location)->get();
            if ($activeJobs) {
                foreach ($activeJobs as $activeJob) {
                    if (!in_array($activeJob->id, $listJob)) {
                        $listJob[] = $activeJob->id;
                    }
                }
            }
        } elseif (!empty($listJobId)) {
            $listJob = $listJobId;
        }

        return $this->getJobByDate($listJob, $per, $url);
    }

    private function getJobByDate($jobs, $per, $url)
    {
        $listJobs = [];
        foreach ($jobs as $job) {
            $job = $this->get('id', $job);
            if ($job) {
                if ($this->compareDateJob($job->out_date)) {
                    $listJobs[] = $job;
                }
            }
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

    public function getJobByCategory($categoryId, $per, $url)
    {
        $listJobs = $this->jobCategory->getJobIdByCategory($categoryId);

        return $this->getJobByDate($listJobs, $per, $url);
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
}
