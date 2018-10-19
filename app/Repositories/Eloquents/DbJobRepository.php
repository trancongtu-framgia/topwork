<?php

namespace App\Repositories\Eloquents;

use App\Models\Job;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\JobRepository;

class DbJobRepository extends DbBaseRepository implements JobRepository
{
    protected $model;

    /**
     *  @param Job $model
     *
     */
    function __construct(Job $model)
    {
        $this->model = $model;
    }
}
