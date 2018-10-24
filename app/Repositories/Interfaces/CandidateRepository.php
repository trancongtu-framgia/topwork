<?php

namespace App\Repositories\Interfaces;

interface CandidateRepository
{
	public function showInfoCandidate($key);

	public function updateInfoCandidate($data, $key, $value);
}

