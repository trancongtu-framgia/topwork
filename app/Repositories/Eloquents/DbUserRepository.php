<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
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

    public function getAll($per)
    {
        // TODO: Implement getAll() method.
    }

    public function create($param)
    {
        // TODO: Implement create() method.
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
        // TODO: Implement delete() method.
    }
}
