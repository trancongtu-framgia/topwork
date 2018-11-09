<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CandidateRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Http\Requests\UpdateCandidateRequest;
use Illuminate\Support\Facades\Auth;
use Exception;

class CandidateController extends Controller
{
    protected  $candidateRepository;
    protected  $userRepository;
    public function __construct(CandidateRepository $candidateRepository, UserRepository $userRepository)
    {
        $this->candidateRepository = $candidateRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Candidate $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }

    public function getInfoCandidate(string $id)
    {
        try {
            $user = $this->candidateRepository->showInfoCandidate($id);
            if (!empty($user) && $user->candidate) {
                $checkAuth = Auth::check() && Auth::user()->token == $user->token;
                $isPublicCandidate = $user->candidate->is_public == config('app.isPublicCandidate');

                return view('clients.candidates.index', compact('user', 'isPublicCandidate', 'checkAuth'));
            } else {
                throw new Exception(__('Cannot find!'));
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function getEditInfoCandidate(string $id)
    {
        if (Auth::user()->token == $id) {
            try {
                $user = $this->candidateRepository->showInfoCandidate($id);
                if (!empty($user)) {
                    return view('clients.candidates.edit', compact('user'));
                } else {
                    throw new Exception(__('Cannot find!'));
                }
            } catch (\Exception $e) {
                return redirect()->back();
            }
        }

        abort(403);
    }

    public function putEditInfoCandidate(UpdateCandidateRequest $request, string $token)
    {
        $candidate = $this->candidateRepository->updateInfoCandidate($request, 'token', $token);

        if ($candidate) {
            $this->removeCache('getAllCandidate');
            flash(__('Edit Profile Success'))->success();

            return redirect()->route('candidate.getInfo', Auth::User()->token);
        } else {
            flash(__('Edit Profile Failed, Please try again!'))->error();

            return redirect()->back();
        }
    }

    public function changeStatus(Request $request)
    {
        $updateStatus = $this->candidateRepository->updateStatus($request->token);

        return $updateStatus;
    }
}
