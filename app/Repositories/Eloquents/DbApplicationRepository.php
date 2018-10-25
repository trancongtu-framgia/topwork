<?php
namespace App\Repositories\Eloquents;

use App\Models\Application;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\ApplicationRepository;

class DbApplicationRepository extends DbBaseRepository implements ApplicationRepository
{
    protected $model;

    /**
     *  @param Application $model
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
}