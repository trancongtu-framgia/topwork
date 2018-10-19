<?php

namespace App\Repositories\Eloquents;

use App\Models\JobCategory;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\JobCategoryRepository;

class DbJobCategoryRepository extends DbBaseRepository implements JobCategoryRepository
{
    protected $model;

    /**
     *  @param JobCategory $model
     *
     */
    function __construct(JobCategory $model)
    {
        $this->model = $model;
    }
}
