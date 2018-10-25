<?php

namespace App\Repositories\Interfaces;

interface JobRepository extends BaseRepository
{
    public function getAllJobByCompany(int $companyId, int $per);

    public function getAllJob($key, $value, $per);

    public function getJobByUser($key, $value);
}
