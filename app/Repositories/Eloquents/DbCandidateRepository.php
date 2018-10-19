<?php

namespace App\Repositories\Eloquents;

use App\Models\Candidate;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\CandidateRepository;

class DbCandidateRepository extends DbBaseRepository implements CandidateRepository
{
    protected $model;

    /**
     *  @param Candidate $model
     *
     */
    function __construct(Candidate $model)
    {
        $this->model = $model;
    }
}
