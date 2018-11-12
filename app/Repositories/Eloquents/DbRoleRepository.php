<?php

namespace App\Repositories\Eloquents;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepository;
use Cache;
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

    public function getAll($per)
    {
        return $this->basePaginateList($per);
    }

    public function get($key, $value)
    {
        return $this->baseFindBy($key, $value);
    }

    public function delete($key, $value)
    {
        return $this->baseDestroy($key, $value);
    }

    public function getAllWithOutPaginate()
    {
        return $this->model::pluck('name', 'id');
    }

    public function create($param)
    {
        return $this->baseCreate($param);
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }

    public function getAllRole()
    {
        $role = Cache::rememberForever('getAllRole', function () {
            return $this->model->all()->toArray();
        });

        return $role;
    }

    public function getRoleIdByName($name)
    {
        $roles = $this->getAllRole();
        foreach ($roles as $role){
            if ($role['name'] == $name) {
                return $role['id'];
            }
        }

    }

    public function getRoleNameById($id)
    {
        $roles = $this->getAllRole();
        foreach ($roles as $role){
            if ($role['id'] == $id) {
                return $role['name'];
            }
        }
    }
}
