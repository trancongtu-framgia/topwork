<?php

namespace App\Repositories\Eloquents;

use App\Models\Company;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\UserRepository;

class DbCompanyRepository extends DbBaseRepository implements CompanyRepository
{
    protected $model;

    /**
     *  @param Company $model
     *
     */
    function __construct(Company $model, UserRepository $userRepository)
    {
        $this->model = $model;
        $this->userRepository = $userRepository;
    }

    public function get($key, $value)
    {
        return $this->baseFindBy($key,$value);
    }

    public function getAll($per)
    {
        return $this->basePaginateList($per);
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }

    public function delete($key, $value)
    {
        return $this->baseDestroy($key, $value);
    }
    public function create($param)
    {
        return $this->baseCreate($param);
    }
    public function getProfile($id)
    {
        $company = $this->get('user_id', $id);
        $companyUserInfo = $this->userRepository->getSpecifiedColumn('id', $id, ['name', 'token']);
        $data = [
            'name' => $companyUserInfo->name,
            'range' => $company->range,
            'working_day' => $company->working_day,
            'country' => $company->country,
            'address' => $company->address,
            'logo' => $company->logo_url,
            'description' => $company->description,
            'token' => $companyUserInfo->token,
        ];

        return $data;
    }

    public function getCompanyName(int $companyId)
    {
        return $this->get('user_id', $companyId)->load('companyUser')->name;
    }
}
