<?php

namespace App\Repositories\Eloquents;

use App\Models\JobType;
use App\Repositories\Interfaces\JobTypeRepository;

class DbJobTypeRepository extends DbBaseRepository implements JobTypeRepository
{
    protected $model;

    /**
     * @param JobType $model
     *
     */
    function __construct(JobType $model)
    {
        $this->model = $model;
    }

    public function getAll($per)
    {
        return $this->basePaginateList($per);
    }

    public function get($key, $value)
    {
        return $this->baseFindBy($key, $value);
    }

    public function delete($key, $value)
    {
        return $this->baseDestroy($key, $value);
    }

    public function getAllWithOutPaginate()
    {
        return $this->model::pluck('name', 'id');
    }

    public function create($param)
    {
        return $this->baseCreate($param);
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }
}
