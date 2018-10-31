<?php

namespace App\Repositories\Interfaces;

interface JobCategoryRepository extends BaseRepository
{
    public function createByJobId(int $jobId, $categoryArray);

    public function getJobIdByCategory($categoryId);

    public function getCategoryByJobId($jobId);
}
