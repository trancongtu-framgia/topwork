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
        $update = DB::transaction(function () use ($data, $value, $key) {
            try {
                $user = $this->userModel->where($key, $value)->first();
                $candidate = $user->candidate;
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

                $saveUser = $user->update($data->toArray());
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
