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
}
