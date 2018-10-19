<?php

namespace App\Repositories\Eloquents;

use App\Models\Company;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\CompanyRepository;

class DbCompanyRepository extends DbBaseRepository implements CompanyRepository
{
    protected $model;

    /**
     *  @param Company $model
     *
     */
    function __construct(Company $model)
    {
        $this->model = $model;
    }
}
