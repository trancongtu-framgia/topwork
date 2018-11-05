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

    public function getJobIdByCategory($categoryId)
    {
        $jobs = $this->model->where('category_id', $categoryId)->get(['job_id']);
        $listIdJob = [];
        if ($jobs) {
            foreach ($jobs as $job) {
                $listIdJob[] = $job->job_id;
            }
        }

        return $listIdJob;
    }

    public function getCategoryByJobId($jobId)
    {
        $categories = $this->model->where('job_id', $jobId)->get(['category_id']);
        $listCategories = [];
        if ($categories) {
            foreach ($categories as $category) {
                $listCategories[] = $category->category_id;
            }
        }

        return $listCategories;
    }
}
