<?php

namespace App\Repositories\Eloquents;

use App\User;
use App\Repositories\Interfaces\UserRepository;
use Cache;

class DbUserRepository extends DbBaseRepository implements UserRepository
{
    protected $model;

    /**
     *  @param User $model
     *
     */
    function __construct(User $model)
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
        return $this->baseFindBy($key, $value);
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }

    public function delete($key, $value)
    {
        // TODO: Implement delete() method.
    }

    public function searchCompanyByName($keyword)
    {
        $listCompany = [];
        $companies = $this->model->where('name', 'like', '%' . $keyword . '%' )->get(['id']);
        if ($companies) {
            foreach ($companies as $company) {
                $listCompany[] = $company->id;
            }
        }

        return $listCompany;
    }

    public function getCompanyByStatus(int $statusCode, int $roleId, $columns = null)
    {
        return $this->model::where('status', $statusCode)->where('role_id', $roleId)->get($columns);
    }

    public function getInformationCompanyByUserId($userId)
    {
        $user = Cache::rememberForever('getInformationCompanyByUserId' . $userId, function () use ($userId) {
             return $this->model->with('userCompany')->where('id', $userId)->first();
        });
        $data = [
            'name' => $user->name,
            'token' => $user->token,
            'company_logo' => $user->userCompany->logo_url
        ];

        return $data;
    }
}
