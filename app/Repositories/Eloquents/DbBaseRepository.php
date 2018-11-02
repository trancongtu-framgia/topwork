<?php

namespace App\Repositories\Eloquents;

class DbBaseRepository
{
    /**
     * Eloquent model
     */
    protected $model;

    /**
     * @param $model
     */
    function __construct($model)
    {
        $this->model = $model;
    }

    public function basePaginateList($per)
    {
        return $this->model->orderBy('id', 'desc')->paginate($per);
    }

    public function baseCreate($data)
    {
        return $this->model->create($data);
    }

    public function baseUpdate($data, $key, $value)
    {
        $obj = $this->model->where($key, $value)->first();

        return $obj->update($data);
    }

    public function baseDestroy($key, $value)
    {
        return $this->model->where($key, $value)->delete();
    }

    public function baseFindBy($key, $value)
    {
        return $this->model->where($key, $value)->first();
    }

    public function baseFindAllBy($key, $value)
    {
        return $this->model->where($key, $value)->orderBy('id', 'desc')->get();
    }

    public function getSpecifiedColumn($key, $value, $array)
    {
        return $this->model::where($key, $value)->first($array);
    }
}
