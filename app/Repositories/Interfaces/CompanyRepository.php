<?php

namespace App\Repositories\Interfaces;


interface CompanyRepository extends BaseRepository
{
    public function getProfile($id);

    public function getCompanyName(int $companyId);

    public function updateInfoCompany($data, $idCompany);
}

