<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LocationRepository;
use App\Repositories\Interfaces\SkillRepository;
use App\Repositories\Interfaces\CategoryRepository;
use phpDocumentor\Reflection\Location;

class HomeController extends Controller
{
    private $location;
    private $skill;
    private $category;
    public function __construct(
        LocationRepository $locationRepository,
        SkillRepository $skillRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->location = $locationRepository;
        $this->skill = $skillRepository;
        $this->category = $categoryRepository;
    }

    public function index()
    {
        $location = $this->location->getAllWithOutPaginate();

        return view('clients.index', compact('location'));
    }
    public function search(Request $request)
    {
        return $request->location;
    }

    public function searchJob(Request $request)
    {
        $data = '';
        $skills = $this->skill->searchSkill($request->value);
        if ($skills) {
            $data = $skills;
        } else {
            $categories = $this->category->searchCategory($request->value);
            if ($categories) {
                $data = $categories;
            }
        }

        return response()->json($data);

    }

}
