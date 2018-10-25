<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\RoleRepository;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    protected const PER_PAGE = 5;
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->getAll(self::PER_PAGE);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $role = $this->roleRepository->create($request->all());
        if ($role) {
            flash(__('Add role successfully'))->success();

            return redirect()->route('roles.index');
        } else {
            flash(__('Add role failed, Please try again'))->error();

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $role = $this->roleRepository->get('id', $id);

        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, int $id)
    {
        $role = $this->roleRepository->update($request->validated(), 'id', $id);
        if ($role) {
            flash(__('Update role success'))->success();
        } else {
            flash(__('Update role failed, Please try again'))->error();
        }

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $role = $this->roleRepository->delete('id', $id);
        if ($role) {
            flash(__('Delete role success'))->success();
        } else {
            flash(__('Delete role failed, Please try again!'));
        }

        return redirect()->route('roles.index');
    }
}
