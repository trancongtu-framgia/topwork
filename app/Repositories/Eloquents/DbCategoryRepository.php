<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\CategoryRepository;

class DbCategoryRepository extends DbBaseRepository implements CategoryRepository
{
    protected $model;

    /**
     *  @param Category $model
     *
     */
    function __construct(Category $model)
    {
        $this->model = $model;
    }
}
