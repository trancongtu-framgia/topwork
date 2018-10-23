<?php

namespace App\Repositories\Interfaces;

interface LocationRepository
{
    public function getListLocations($per);

    public function createLocation($param);

    public function getLocation($key, $value);

    public function updateLocation($data, $key, $value);

    public function deleteLocation($key, $value);
}

