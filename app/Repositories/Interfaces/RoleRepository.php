<?php

namespace App\Repositories\Interfaces;

interface RoleRepository extends BaseRepository
{
    public function getRoleIdByName($name);

    public function getRoleNameById($id);
}
