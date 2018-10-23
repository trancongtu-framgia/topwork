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

    public function getListLocations($per)
    {
        return $this->paginateList($per);
    }

    public function createLocation($param)
    {
        return $this->create($param);
    }

    public function getLocation($key, $value)
    {
        return $this->findBy($key, $value);
    }

    public function updateLocation($data, $key, $value)
    {
        return $this->update($data, $key, $value);
    }

    public function deleteLocation($key, $value)
    {
        return $this->destroy($key, $value);
    }
}
