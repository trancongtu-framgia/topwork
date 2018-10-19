<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\UserRepository;

class DbUserRepository extends DbBaseRepository implements UserRepository
{
    protected $model;

    /**
     *  @param User $model
     *
     */
    function __construct(User $model)
    {
        $this->model = $model;
    }
}
