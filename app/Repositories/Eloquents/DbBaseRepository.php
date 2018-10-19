<?php

namespace App\Repositories\Eloquents;

class DbBaseRepository {

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

    public function paginateList($per)
    {
        return $this->model->orderBy('id', 'desc')->paginate($per);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $key, $value)
    {
        $obj = $this->model->where($key, $value);
        
        return $obj->update($data);
    }

    public function destroy($key, $value)
    {
        return $this->model->where($key, $value)->delete();
    }

    public function findBy($key, $value)
    {
        return $this->model->where($key, $value)->first();
    }

    public function findAllBy($key, $value)
    {
        return $this->model->where($key, $value)->get();
    }
}
