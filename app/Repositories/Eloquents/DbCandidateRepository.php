<?php

namespace App\Repositories\Eloquents;

use App\Models\Candidate;
use App\Models\User;
use App\Repositories\Interfaces\CandidateRepository;
use DB;
use Mockery\Exception;
use Cache;

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

    public function get($key, $value)
    {
        return $this->baseFindBy($key, $value);
    }

    public function create($param)
    {
        return $this->baseCreate($param);
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

    public function getAllCandidate ()
    {
        $listCandidate = [];
        $candidates = Cache::rememberForever('getAllCandidate', function () {
            return $this->model->all('user_id');
        });
        foreach ($candidates as $candidate) {
            $listCandidate[] = $candidate->user_id;
        }

        return $listCandidate;
    }

    public function updateStatus($token)
    {
        $candidate = $this->userModel->where('token', $token)->first()->candidate;
        $candidate->is_public = (int)$candidate->is_public == config('app.isPublicCandidate') ? config('app.isNotPublicCandidate') : config('app.isPublicCandidate');
        if ($candidate->save()) {
            return 'true';
        }

        return 'false';
    }
}
