<?php

namespace App\Repositories\Interfaces;

interface JobTypeRepository extends BaseRepository
{
    public function getAllWithOutPaginate();
}
