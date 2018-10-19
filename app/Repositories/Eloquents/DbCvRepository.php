<?php

namespace App\Repositories\Eloquents;

use App\Models\Cv;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\CvRepository;

class DbCvRepository extends DbBaseRepository implements CvRepository
{
    protected $model;

    /**
     *  @param Cv $model
     *
     */
    function __construct(Cv $model)
    {
        $this->model = $model;
    }
}
