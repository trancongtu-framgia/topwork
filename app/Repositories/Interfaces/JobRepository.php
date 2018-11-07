<?php

namespace App\Repositories\Interfaces;

interface JobRepository extends BaseRepository
{
    public function getAllJobByCompany(int $companyId, int $per);

    public function getAllJob($key, $value);

    public function getJobByUser($key, $value);

    public function searchJob($keyword, $location, $per, $url);

    public function getJobBySalaryCategory($salary, $categoryId, $per, $url);
}
