<?php

namespace App\Repositories\Eloquents;

use App\Models\Role;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\RoleRepository;

class DbRoleRepository extends DbBaseRepository implements RoleRepository
{
    protected $model;

    /**
     *  @param Role $model
     *
     */
    function __construct(Role $model)
    {
        $this->model = $model;
    }
}
