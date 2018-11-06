<?php

namespace App\Repositories\Eloquents;

use App\Models\JobSkill;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\JobSkillRepository;

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

    public function findAllByJobId(int $jobId)
    {
        return $this->model::with('skillJobs')->where('job_id', $jobId)->get();
    }

    public function findAllJobBySkill($skills)
    {
        $listIdJob = [];
        foreach ($skills as $skill) {
            foreach ($this->model->where('skill_id', $skill->id)->get(['id']) as $job) {
                if (!in_array($job->job_id, $listIdJob)) {
                    $listIdJob[] = $job->job_id;
                }
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
