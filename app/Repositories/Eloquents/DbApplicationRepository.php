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
}
