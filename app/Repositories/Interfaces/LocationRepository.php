<?php

namespace App\Repositories\Interfaces;

interface LocationRepository extends BaseRepository
{
    public function getAllWithOutPaginate();

    public function getNameById($id);
}
