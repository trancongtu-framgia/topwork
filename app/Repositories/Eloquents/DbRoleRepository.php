<?php

namespace App\Repositories\Eloquents;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepository;

class DbRoleRepository extends DbBaseRepository implements RoleRepository
{
    protected $model;

    /**
     * @param Role $model
     *
     */
    function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function getListRoles($per)
    {
        return $this->paginateList($per);
    }

    public function createRole($param)
    {
        return $this->create($param);
    }

    public function getRole($key, $value)
    {
        return $this->findBy($key, $value);
    }

    public function updateRole($data, $key, $value)
    {
        return $this->update($data, $key, $value);
    }

    public function deleteRole($key, $value)
    {
        return $this->destroy($key, $value);
    }
}
