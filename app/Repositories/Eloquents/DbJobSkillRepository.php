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
}
