<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use App\Repositories\Eloquents\DbCategoryRepository;
use App\Repositories\Eloquents\DbSkillRepository;

class SkillController extends Controller
{
    protected const RECORD_PER_PAGE = 5;
    protected $skillRepository;
    protected $categoryRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(DbSkillRepository $skillRepository, DbCategoryRepository $categoryRepository)
    {
        $this->skillRepository = $skillRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $skills = $this->skillRepository->getAll(self::RECORD_PER_PAGE);

        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAllWithOutPaginate()->toArray();

        return view('admin.skills.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $request)
    {
        $validatedData = $request->validated();
        $recentlyAddedSkill = $this->skillRepository->create($validatedData);
        if ($recentlyAddedSkill) {
            flash(__('Add successfully'))->success();

            return redirect()->route('skills.index');
        } else {
            flash(__('Add fail'))->error();

            return redirect()->route('skills.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(int $skillID)
    {
        $categories = $this->categoryRepository->getAllWithOutPaginate()->toArray();
        $skill = $this->skillRepository->get('id', $skillID);

        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function update(SkillRequest $request, int $skillId)
    {
        $recentlyUpdatedSkill = $this->skillRepository->update($request->validated(), 'id', $skillId);
        if ($recentlyUpdatedSkill) {
            flash(__('Edit successfully'))->success();

            return redirect()->route('skills.index');
        } else {
            flash(__('Edit fail'))->error();

            return redirect()->route('skills.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $skillId)
    {
        $recentlyDeletedSkill = $this->skillRepository->delete('id', $skillId);
        if ($recentlyDeletedSkill) {
            flash(__('Delete successfully'))->success();

            return redirect()->route('skills.index');
        } else {
            flash(__('Delete fail'))->error();

            return redirect()->route('skills.index');
        }
    }
}
