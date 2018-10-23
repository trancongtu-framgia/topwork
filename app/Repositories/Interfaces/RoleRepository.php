<?php

namespace App\Repositories\Interfaces;

interface RoleRepository
{
    public function getListRoles($per);

    public function createRole($param);

    public function getRole($key, $value);

    public function updateRole($data, $key, $value);

    public function deleteRole($key, $value);
}
