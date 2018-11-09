<?php

namespace App\Repositories\Eloquents;

use App\Models\JobSkill;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\JobSkillRepository;
use Cache;

class DbJobSkillRepository extends DbBaseRepository implements JobSkillRepository
{
    protected $model;

    /**
     *  @param JobSkill $model
     *
     */
    function __construct(JobSkill $model)
    {
        $this->model = $model;
    }

    public function getAll($per)
    {
        return $this->basePaginateList($per);
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

    public function createByJobId(int $jobId, $skillArray)
    {
        foreach ($skillArray as $skill) {
            $this->create(['job_id' => $jobId, 'skill_id' => $skill]);
        }
    }
    public function getAllJobSkill()
    {
        $jobSkills = Cache::rememberForever('getAllJobSkill', function () {
            return $this->model->all()->toArray();
        });

        return $jobSkills;
    }

    public function findAllByJobId(int $jobId)
    {
        $skills = [];
        $jobskills = $this->getAllJobSkill();
        foreach ($jobskills as $jobskill) {
            if ($jobskill['job_id'] == $jobId) {
                    $skills[] = $jobskill['skill_id'];
            }
        }

        return $skills;
    }

    public function findAllJobBySkill($skills)
    {
        $listIdJob = [];
         $jobs = $this->model->whereIn('skill_id', $skills)->get(['job_id']);
         if ($jobs) {
             foreach ($jobs as $job) {
                 $listIdJob[] = $job->job_id;
             }
         }

        return $listIdJob;
    }

    public function getSkillByJobId($jobId)
    {
        $listSkill = [];
        $skills = $this->model->where('job_id', $jobId)->get(['skill_id']);
        if ($skills) {
            foreach ($skills as $skill) {
                $listSkill[] = $skill->skill_id;
            }
        }

        return $listSkill;
    }
}
