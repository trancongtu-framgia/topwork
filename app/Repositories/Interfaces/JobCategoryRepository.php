<?php

namespace App\Repositories\Interfaces;

interface JobCategoryRepository extends BaseRepository
{
    public function createByJobId(int $jobId, $categoryArray);
}
