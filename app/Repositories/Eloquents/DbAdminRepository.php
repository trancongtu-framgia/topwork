<?php

namespace App\Repositories\Eloquents;

use App\Models\Admin;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\AdminRepository;

class DbAdminRepository extends DbBaseRepository implements AdminRepository
{
    protected $model;

    /**
     *  @param Admin $model
     *
     */
    function __construct(Admin $model)
    {
        $this->model = $model;
    }
}
