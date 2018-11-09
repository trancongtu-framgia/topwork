<?php

namespace App\Repositories\Interfaces;

interface JobTypeRepository extends BaseRepository
{
    public function getAllWithOutPaginate();

    public function searchJobTypeByName($keyword);

    public function getNameById($id);
}
