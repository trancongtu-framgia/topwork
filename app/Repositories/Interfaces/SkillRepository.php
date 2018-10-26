<?php

namespace App\Repositories\Interfaces;

interface SkillRepository extends BaseRepository
{
    public function getAllWithOutPaginate();
}
