<?php

namespace App\Repositories\Interfaces;

interface JobTypeRepository
{
	public function getListJobType ($per);

	public function createJobType ($param);

	public function getJobType ($key, $value);

	public function updateJobType ($data, $key, $value);

	public function deleteJobType ($key, $value);
}

