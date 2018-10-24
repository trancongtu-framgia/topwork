<?php

namespace App\Repositories\Interfaces;


interface CompanyRepository extends BaseRepository
{
    public function getProfile($id);

}

