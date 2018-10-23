<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/10/2018
 * Time: 13:24
 */

namespace App\Repositories\Interfaces;


interface BaseRepository
{
    public function getAll($per);

    public function create($param);

    public function get($key, $value);

    public function update($data, $key, $value);

    public function delete($key, $value);

}
