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
    protected $jobTypeReponsitory;

    public function __construct(JobTypeRepository $jobTypeRepository)
    {
        $this->jobTypeReponsitory = $jobTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobTypes = $this->jobTypeReponsitory->getListJobType(self::PER_PAGE);
        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJobTypeRequest $request)
    {
        $jobType = $this->jobTypeReponsitory->createJobType($request->all());
        if ($jobType) {
            flash('Thêm thành công')->success();
        } else {
            flash('Thêm thất bai, Vui lòng thử lại')->error();
        }

        return redirect()->route('job-type.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $jobType = $this->jobTypeReponsitory->getJobType('id', $id);

        return view('admin.job_types.edit', compact('jobType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobTypeRequest $request, int $id)
    {
        $jobType = $this->jobTypeReponsitory->updateJobType($request, 'id', $id);
        if ($jobType) {
            flash('Sửa thành công')->success();

            return redirect()->route('job-type.index');
        } else {
            flash('Sửa thất bại, vui lòng thử lại')->error();

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $jobType = $this->jobTypeReponsitory->deleteJobType('id', $id);
        if ($jobType) {
            flash('Xóa thành công')->success();
        } else {
            flash('Xóa thất bại, Vui lòng thử lại!')->error();
        }

        return redirect()->route('job-type.index');
    }
}
