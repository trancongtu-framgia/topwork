<?php

namespace App\Repositories\Eloquents;

use App\Models\Candidate;
use App\Models\User;
use App\Repositories\Interfaces\CandidateRepository;
use DB;
use Mockery\Exception;

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
        return $this->userModel->where('token', $key)->first();
    }

    public function updateInfoCandidate($data, $key, $value)
    {
        $update = DB::transaction(function () use ($data, $value) {
            try {
                $candidate = $this->model->find($value);
                if ($data->hasFile('avatar')) {
                    $file = $data->file('avatar');
                    $name = $file->getClientOriginalName();
                    $image = str_random(4) . '_' . $name;
                    $file->move(config('app.candidate_media_url'), $image);
                    if (!empty($candidate->avatar_url) &&
                        file_exists(config('app.candidate_media_url') . $candidate->avatar_url)) {
                        unlink(config('app.candidate_media_url') . $candidate->avatar_url);
                    }
                    $data['avatar_url'] = $image;
                }
                $saveCandidate = $candidate->update($data->toArray());

                if (!empty($candidate->user_id)) {
                    $user = $this->userModel->find($candidate->user_id);
                    $saveUser = $user->update($data->toArray());
                } else {
                    return false;
                }
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
