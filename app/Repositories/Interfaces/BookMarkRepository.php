<?php

namespace App\Repositories\Interfaces;

interface BookMarkRepository extends BaseRepository
{
    public function getBookMarkByUser($key, $value);
}

