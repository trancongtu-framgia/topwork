<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\CategoryRepository;
use Cache;

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
        $getCategories = Cache::rememberForever('getCategory', function () {
            return $this->model::pluck('name', 'id');
        });

        return $getCategories;
    }
    public function create($param)
    {
        return $this->baseCreate($param);
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }

    public function getCategoryByBookMark($idCategories)
    {
        $categories = $this->getAllWithOutPaginate();
        $listCategories = [];
        foreach ($categories as $key => $value) {
            foreach ($idCategories as $idCategory) {
                if ($idCategory == $key) {
                    $listCategories[$key] = $value;
                }
            }
        }

        return $listCategories;
    }

}
