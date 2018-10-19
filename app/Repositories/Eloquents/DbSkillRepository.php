<?php

namespace App\Repositories\Eloquents;

use App\Models\Skill;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\SkillRepository;

class DbSkillRepository extends DbBaseRepository implements SkillRepository
{
    protected $model;

    /**
     *  @param Skill $model
     *
     */
    function __construct(Skill $model)
    {
        $this->model = $model;
    }
}
