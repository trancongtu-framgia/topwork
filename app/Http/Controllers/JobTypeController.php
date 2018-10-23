<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\JobTypeRepository;
use App\Http\Requests\CreateJobTypeRequest;
use App\Http\Requests\UpdateJobTypeRequest;

class JobTypeController extends Controller
{
    const PER_PAGE = 5;
    protected $jobTypeRepository;

    public function __construct(JobTypeRepository $jobTypeRepository)
    {
        $this->jobTypeRepository = $jobTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobTypes = $this->jobTypeRepository->getListJobType(self::PER_PAGE);

        return view('admin.job_types.index', compact('jobTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.job_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJobTypeRequest $request)
    {
        $jobType = $this->jobTypeRepository->createJobType($request->all());
        if ($jobType) {
            flash(__('Add Job Type succes'))->success();
        } else {
            flash(__('Add Job failed, Please try again!'))->error();
        }

        return redirect()->route('job-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobType $jobType
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $jobType = $this->jobTypeRepository->getJobType('id', $id);

        return view('admin.job_types.edit', compact('jobType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\JobType $jobType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobTypeRequest $request, int $id)
    {
        $jobType = $this->jobTypeRepository->updateJobType($request, 'id', $id);
        if ($jobType) {
            flash(__('Update Job Type succes'))->success();

            return redirect()->route('job-types.index');
        } else {
            flash(__('Update Job failed, Please try again!'))->error();

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobType $jobType
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $jobType = $this->jobTypeRepository->deleteJobType('id', $id);
        if ($jobType) {
            flash(__('Delete Job Type succes'))->success();
        } else {
            flash(__('Delete Job failed, Please try again!'))->error();
        }

        return redirect()->route('job-types.index');
    }
}
