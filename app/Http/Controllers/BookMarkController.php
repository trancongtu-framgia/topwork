<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\BookMarkRepository;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use DB;

class BookMarkController extends Controller
{
    protected $categoryRepository;
    protected $bookMarkRepository;
    protected $userRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        BookMarkRepository $bookMarkRepository,
        UserRepository $userRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->bookMarkRepository = $bookMarkRepository;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $results = DB::transaction(function () use ($request) {
            try {
                $bookMarks = [];
                foreach ($request->cb as $key => $categoryId) {
                    $dataBookMark['category_id'] = $categoryId;
                    $dataBookMark['user_id'] = Auth::User()->id;
                    $bookMarks[] = $this->bookMarkRepository->create($dataBookMark);
                }
                $dataUser['is_first_login'] = config('app.is_first_logged');
                $user = $this->userRepository->update($dataUser, 'id', Auth::User()->id);
                DB::commit();

                return true;
            } catch (\Exception $e) {
                DB::rollBack();

                return $e;
            }
        });

        if ($results) {
            return redirect()->route('home.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookMark  $bookMark
     * @return \Illuminate\Http\Response
     */
    public function edit(BookMark $bookMark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookMark  $bookMark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookMark $bookMark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookMark  $bookMark
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookMark $bookMark)
    {
        //
    }

    public function getView()
    {
        $categories = $this->categoryRepository->getAllWithOutPaginate();

        return view('clients.bookmarks.index', compact('categories'));
    }
}
