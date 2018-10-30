<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CandidateRepository;
use App\Http\Requests\UpdateCandidateRequest;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
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
        $user = $this->candidateRepository->showInfoCandidate($id);

        return view('clients.candidates.index', compact('user'));
    }

    public function getEditInfoCandidate(string $id)
    {
        $user = $this->candidateRepository->showInfoCandidate($id);

        return view('clients.candidates.edit', compact('user'));
    }

    public function putEditInfoCandidate(UpdateCandidateRequest $request, int $id)
    {
        $candidate = $this->candidateRepository->updateInfoCandidate($request, 'id', $id);

        if ($candidate) {
            flash(__('Edit Profile Success'))->success();

            return redirect()->route('candidate.getInfo', Auth::User()->token);
        } else {
            flash(__('Edit Profile Failed, Please try again!'))->error();

            return redirect()->back();
        }
    }
}
