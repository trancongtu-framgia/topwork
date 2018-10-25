<?php

namespace App\Repositories\Eloquents;

use App\Models\Company;
use App\Repositories\Eloquents\DbBaseRepository;
use App\Repositories\Interfaces\CompanyRepository;

class DbCompanyRepository extends DbBaseRepository implements CompanyRepository
{
    protected $model;

    /**
     *  @param Company $model
     *
     */
    function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function get($key, $value)
    {
        return $this->baseFindBy($key,$value);
    }

    public function getAll($per)
    {
        // TODO: Implement getAll() method.
    }

    public function update($data, $key, $value)
    {
        // TODO: Implement update() method.
    }

    public function delete($key, $value)
    {
        // TODO: Implement delete() method.
    }
    public function create($param)
    {
        // TODO: Implement create() method.
    }
    public function getProfile($id)
    {
        $company = $this->get('user_id', $id);
        $data = [
            'name' => $company->companyUser->name,
            'range' => $company->range,
            'working_day' => $company->working_day,
            'country' => $company->country,
            'address' => $company->address,
            'logo' => $company->logo_url,
            'description' => $company->description,
        ];

        return $data;
    }
    public function getCompanyName(int $companyId)
    {
        return $this->get('user_id', $companyId)->companyUser->name;
    }
}
