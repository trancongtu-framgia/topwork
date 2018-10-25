<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\LocationRepository;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Requests\CreateLocationRequest;

class LocationController extends Controller
{
    protected const PER_PAGE = 5;
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = $this->locationRepository->getAll(self::PER_PAGE);

        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLocationRequest $request)
    {
        $location = $this->locationRepository->create($request->all());
        if ($location) {
            flash(__('Add location successfully'))->success();

            return redirect()->route('locations.index');
        } else {
            flash(__('Add location failed, Please try again'))->error();

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $location = $this->locationRepository->get('id', $id);

        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, $id)
    {
        $location = $this->locationRepository->update($request->validated(), 'id', $id);

        if ($location) {
            flash(__('Update location success'))->success();
        } else {
            flash(__('Update location failed, Please try again'))->error();
        }

        return redirect()->route('locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $location = $this->locationRepository->delete('id', $id);

        if ($location) {
            flash(__('Delete location success'))->success();
        } else {
            flash(__('Delete location failed, Please try again!'));
        }

        return redirect()->route('locations.index');
    }
}
