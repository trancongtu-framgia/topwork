<?php

namespace App\Repositories\Interfaces;

interface JobSkillRepository extends BaseRepository
{
    public function createByJobId(int $jobId, $skillArray);

    public function findAllByJobId(int $jobId);

    public function findAllJobBySkill($skills);

    public function getSkillByJobId($jobId);

}
