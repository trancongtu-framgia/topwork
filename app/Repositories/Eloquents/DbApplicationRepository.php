<?php

namespace App\Repositories\Eloquents;

use App\Models\Application;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\ApplicationRepository;

class DbApplicationRepository extends DbBaseRepository implements ApplicationRepository
{
    protected $model;

    /**
     * @param Application $model
     *
     */
    function __construct(Application $model)
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

    public function checkDuplicate(int $user_id, int $job_id): bool
    {
        $count = $this->model::where('user_id', $user_id)->where('job_id', $job_id)->get()->count();

        return $count === 0 ? true : false;
    }

    public function getAllAppliedJobByUser(int $userId)
    {
        return $this->model::where('user_id', $userId)->get();
    }

    public function getApplicationByUserAndJob ($jobId, $userId)
    {
        return $this->model::where('job_id', $jobId)->where('user_id', $userId)->first();
    }
}
