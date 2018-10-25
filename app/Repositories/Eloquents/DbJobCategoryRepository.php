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

    public function createByJobId(int $jobId, $categoryArray)
    {
        foreach ($categoryArray as $category) {
            $this->create(['job_id' => $jobId, 'category_id' => $category]);
        }
    }
}
