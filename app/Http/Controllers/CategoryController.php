<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Eloquents\DbCategoryRepository;

class CategoryController extends Controller
{
    protected const RECORD_PER_PAGE = 5;
    protected $categoryRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(DbCategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll(self::RECORD_PER_PAGE);
        $this->setParentCategoryName($categories);

        return view('admin.categories.index', compact('categories'));
    }

    private function setParentCategoryName(&$categories): void
    {
        foreach ($categories as $key => &$category) {
            if ($category->parent_id !== 0) {
                $category['parent_category'] = $this->categoryRepository->baseFindBy('id', $category->parent_id)->name;
            } else {
                $category['parent_category'] = 'none';
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAllWithOutPaginate()->toArray();
        $categories[0] = 'None';

        return view('admin.categories.create', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();
        $recentlyAddedCategory = $this->categoryRepository->create($validatedData);
        if ($recentlyAddedCategory) {
            $this->removeCache('getCategory');
            flash(__('Add successfully'))->success();

            return redirect()->route('categories.index');
        } else {
            flash(__('Add fail'))->error();

            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(int $categoryId)
    {
        $categories = $this->categoryRepository->getAllWithOutPaginate()->toArray();
        $categories[0] = 'None';
        $category = $this->categoryRepository->baseFindBy('id', $categoryId);

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, int $categoryId)
    {
        $recentlyUpdatedCategory = $this->categoryRepository->update($request->validated(), 'id', $categoryId);
        if ($recentlyUpdatedCategory) {
            $this->removeCache('getCategory');
            flash(__('Edit successfully'))->success();

            return redirect()->route('categories.index');
        } else {
            flash(__('Edit fail'))->error();

            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $categoryId)
    {
        $recentlyDeletedCategory = $this->categoryRepository->delete('id', $categoryId);
        if ($recentlyDeletedCategory) {
            $this->removeCache('getCategory');
            flash(__('Delete successfully'))->success();

            return redirect()->route('categories.index');
        } else {
            flash(__('Delete fail'))->error();

            return redirect()->route('categories.index');
        }
    }
}
