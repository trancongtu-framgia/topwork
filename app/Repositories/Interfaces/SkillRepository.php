<?php

namespace App\Repositories\Interfaces;

interface SkillRepository extends BaseRepository
{
    public function getAllWithOutPaginate();

    public function searchSkill($keyword);

    public function searchSkillByName($name);

    public function getSkillByCategory($categories);
}
