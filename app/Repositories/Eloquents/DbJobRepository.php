<?php

namespace App\Repositories\Eloquents;

use App\Models\Job;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\JobRepository;
use App\Repositories\Interfaces\JobSkillRepository;

class DbJobRepository extends DbBaseRepository implements JobRepository
{
    protected $model;
    protected $jobSkillRepository;
    protected $companyRepository;

    /**
     * @param Job $model
     *
     */
    function __construct(Job $model, JobSkillRepository $jobSkillRepository, CompanyRepository $companyRepository)
    {
        $this->model = $model;
        $this->jobSkillRepository = $jobSkillRepository;
        $this->companyRepository = $companyRepository;
    }

    public function getAll($per)
    {
        $jobs = $this->basePaginateList($per);

        return $this->getJobWithSkillName($jobs);
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
            foreach ($skills as $skill) {
                $skillName[] = $skill->skillJobs->name;
            }
            $jobsWithSkill[] = [
                'job' => $job,
                'skills' => $skillName,
                'company_name' => $this->companyRepository->getCompanyName($job->user_id),
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
}
