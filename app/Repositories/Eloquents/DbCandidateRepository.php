<?php

namespace App\Repositories\Eloquents;

use App\Models\Candidate;
use App\Models\User;
use App\Repositories\Interfaces\CandidateRepository;

class DbCandidateRepository extends DbBaseRepository implements CandidateRepository
{
    protected $model;
    protected $userModel;

    /**
     * @param Candidate $model
     *
     */
    function __construct(Candidate $model, User $userModel)
    {
        $this->model = $model;
        $this->userModel = $userModel;
    }

    public function showInfoCandidate($key)
    {
        return $this->userModel->find($key)->first();
    }

    public function updateInfoCandidate($data, $key, $value)
    {
        $candidate = $this->model->find($value);
        $candidate->name = $data->name;
        $candidate->dob = $data->dob;
        $candidate->user_id = $candidate->user_id;
        $candidate->address = $data->address;
        $candidate->phone = $data->phone;
        $candidate->description = $data->description;
        $candidate->facebook = $data->facebook;
        $candidate->youtube = $data->youtube;
        $candidate->twiter = $data->twister;
        $candidate->experience = $data->experience;

        if ($data->hasFile('avatar_url')) {
            $file = $data->file('avatar_url');
            $name = $file->getClientOriginalName();
            $image = str_random(4) . '_' . $name;
            $file->move('public/upload/image_candidate/', $image);
            if (!empty($candidate->image)) {
                unlink('public/upload/image_candidate/' . $candidate->image);
            }
            $candidate->avatar_url = $image;
        }
        $result = $candidate->save();

        return $result;
    }
}
