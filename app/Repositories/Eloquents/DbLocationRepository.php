<?php

namespace App\Repositories\Eloquents;

use App\Models\Location;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\LocationRepository;

class DbLocationRepository extends DbBaseRepository implements LocationRepository
{
    protected $model;

    /**
     *  @param Location $model
     *
     */
    function __construct(Location $model)
    {
        $this->model = $model;
    }
}
