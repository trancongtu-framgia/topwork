<?php

namespace App\Repositories\Interfaces;

interface UserRepository extends BaseRepository
{
    public function searchCompanyByName($keyword);
}
