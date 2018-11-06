<?php

namespace App\Repositories\Interfaces;

interface CandidateRepository extends BaseRepository
{
	public function showInfoCandidate($key);

	public function updateInfoCandidate($data, $key, $value);

    public function updateStatus($token);
}

