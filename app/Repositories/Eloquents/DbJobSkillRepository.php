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
        return $this->baseFindAllBy('job_id', $jobId);
    }
}
