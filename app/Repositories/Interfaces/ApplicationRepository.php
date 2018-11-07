<?php

namespace App\Repositories\Interfaces;

interface ApplicationRepository extends BaseRepository
{
    public function checkDuplicate(int $user_id, int $job_id);

    public function getApplicationByUserAndJob ($jobId, $userId);

    public function getAllApplicationByJob($key, $value, $per);
}
