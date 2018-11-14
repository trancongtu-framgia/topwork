<?php

namespace App\Repositories\Eloquents;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\UserRepository;
use DB;

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
        $companyUserInfo = $this->userRepository->getSpecifiedColumn('id', $id, [
            'id',
            'name',
            'status',
            'token',
        ]);
        $data = [
            'user_id' => $companyUserInfo->id,
            'name' => $companyUserInfo->name,
            'range' => $company->range,
            'working_day' => $company->working_day,
            'country' => $company->country,
            'address' => $company->address,
            'logo' => $company->logo_url,
            'description' => $company->description,
            'active' => $companyUserInfo->status,
            'token' => $companyUserInfo->token,
        ];

        return $data;
    }

    public function getCompanyName(int $companyId)
    {
        return $this->get('user_id', $companyId)->load('companyUser')->name;
    }

    public function updateInfoCompany($data, $idCompany)
    {
        $update = DB::transaction(function () use ($data, $idCompany) {
            try {
                $company = $this->model->where('id', $idCompany)->first();
                if ($data->hasFile('avatar')) {
                    $file = $data->file('avatar');
                    $name = $file->getClientOriginalName();
                    $image = str_random(4) . '_' . $name;
                    $file->move(config('app.company_media_url'), $image);
                    if ($company->logo_url != config('app.image_default') &&
                        file_exists(config('app.company_media_url') . $company->logo_url)) {
                        unlink(config('app.company_media_url') . $company->logo_url);
                    }
                    $data['logo_url'] = $image;
                }
                $saveCompany = $company->update($data->toArray());

                $saveUser = $company->companyUser->update($data->toArray());

                DB::commit();

                return true;
            } catch (Exception $exception) {
                DB::rollback();

                return ['errorMessage' => $exception->getMessage()];
            }
        });

        return $update;
    }
}
