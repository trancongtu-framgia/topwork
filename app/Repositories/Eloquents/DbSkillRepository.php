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
}
