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

    public function getAll($per)
    {
        return $this->basePaginateList($per);
    }

    public function get($key, $value)
    {
        return $this->baseFindBy($key, $value);
    }

    public function delete($key, $value)
    {
        return $this->baseDestroy($key, $value);
    }

    public function getAllWithOutPaginate()
    {
        return $this->model::pluck('name', 'id');
    }

    public function create($param)
    {
        return $this->baseCreate($param);
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }

}
