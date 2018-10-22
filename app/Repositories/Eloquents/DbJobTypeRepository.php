<?php

namespace App\Repositories\Eloquents;

use App\Models\JobType;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\JobTypeRepository;

class DbJobTypeRepository extends DbBaseRepository implements JobTypeRepository
{
    protected $model;

    /**
     *  @param JobType $model
     *
     */
    function __construct(JobType $model)
    {
        $this->model = $model;
    }

    public function getListJobType ($per)
    {
        return $this->paginateList($per);
    }

    public function createJobType ($request)
    {
        return $this->create($request);
    }

    public function getJobType ($key, $value)
    {
        return $this->findBy($key, $value);
    }

    public function updateJobType ($data, $key, $value)
    {
        return $this->update($data, $key, $value);
    }

    public function deleteJobType($key, $value)
    {
        return $this->destroy($key, $value);
    }
}
