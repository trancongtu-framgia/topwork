<?php

namespace App\Repositories\Eloquents;

use App\Models\Skill;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\SkillRepository;
use Cache;

class DbSkillRepository extends DbBaseRepository implements SkillRepository
{
    protected $model;

    /**
     * @param Skill $model
     *
     */
    function __construct(Skill $model)
    {
        $this->model = $model;
    }

    public function getAll($per)
    {
        return $this->basePaginateList($per);
    }

    public function create($param)
    {
        return $this->baseCreate($param);
    }

    public function get($key, $value)
    {
        return $this->baseFindBy($key, $value);
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }

    public function delete($key, $value)
    {
        return $this->baseDestroy($key, $value);
    }

    public function getAllWithOutPaginate()
    {
        return $this->model::pluck('name', 'id');
    }

    public function searchSkill($keyword)
    {
        return $this->model->where('name', 'like', '%' . $keyword . '%')->get();
    }

    public function searchSkillByName($name)
    {
        $skills = [];
        $data = $this->model->where('name', 'like', '%' . $name . '%')->get(['id']);
        if ($data) {
            foreach ($data as $skill) {
                $skills[] = $skill->id;
            }
        }

        return $skills;
    }

    public function getSkillByCategory($categories)
    {
        if ($categories) {
            $skills = $this->model->whereIn('category_id', $categories)->get(['id', 'name'])->toArray();
        }

        return $skills;
    }

    public function getAllSkills ()
    {
        $skills = Cache::rememberForever('getAllSkills', function () {
            return $this->model->all()->toArray();
        });

        return $skills;
    }

    public function getNameSkillById($id)
    {
        $skills = $this->getAllSkills();
        $skillName = '';
        foreach ($skills as $skill) {
            if ($skill['id'] == $id) {
                $skillName = $skill['name'];
            }
        }

        return $skillName;
    }

}
