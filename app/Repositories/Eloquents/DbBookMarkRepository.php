<?php

namespace App\Repositories\Eloquents;

use App\Models\BookMark;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\BookMarkRepository;

class DbBookMarkRepository extends DbBaseRepository implements BookMarkRepository
{
    protected $model;

    /**
     *  @param BookMark $model
     *
     */
    function __construct(BookMark $model)
    {
        $this->model = $model;
    }
}
