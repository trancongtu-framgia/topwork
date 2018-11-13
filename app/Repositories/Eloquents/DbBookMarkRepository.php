<?php

namespace App\Repositories\Eloquents;

use App\Models\BookMark;
use App\Repositories\Interfaces\BookMarkRepository;

class DbBookMarkRepository extends DbBaseRepository implements BookMarkRepository
{
    protected $model;

    /**
     *  @param BookMark $model
     *
     */
    function __construct(BookMark $model)
    {
        $this->model = $model;
    }


    public function getAll($per)
    {
        // TODO: Implement getAll() method.
    }

    public function create($param)
    {
        return $this->baseCreate($param);
    }

    public function get($key, $value)
    {
        // TODO: Implement get() method.
    }

    public function update($data, $key, $value)
    {
        // TODO: Implement update() method.
    }

    public function delete($key, $value)
    {
        return $this->baseDestroy($key, $value);
    }

    public function getBookMarkByUser($key, $value)
    {
        return $this->model->where($key, $value)->pluck('category_id');
    }
}
