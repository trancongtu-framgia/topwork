<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LocationRepository;
use App\Repositories\Interfaces\SkillRepository;
use App\Repositories\Interfaces\CategoryRepository;
use phpDocumentor\Reflection\Location;
use App\Repositories\Interfaces\JobRepository;

class HomeController extends Controller
{
    private $location;
    private $skill;
    private $category;
    private const RECORD_PER_PAGE = 10;
    private $jobRepository;

    public function __construct(
        LocationRepository $locationRepository,
        SkillRepository $skillRepository,
        CategoryRepository $categoryRepository,
        JobRepository $jobRepository
    ) {
        $this->location = $locationRepository;
        $this->skill = $skillRepository;
        $this->category = $categoryRepository;
        $this->jobRepository = $jobRepository;
    }

    public function index()
    {
        $jobs = $this->jobRepository->getAll(self::RECORD_PER_PAGE);
        $location = $this->location->getAllWithOutPaginate();

        return view('clients.index', compact('location', 'jobs'));
    }

    public function search(Request $request)
    {
        $jobs = $this->jobRepository->searchJob($request->keyword, $request->location, self::RECORD_PER_PAGE, $request->fullUrl());
        $location = $this->location->getAllWithOutPaginate();

        return view('clients.home.search', compact('jobs', 'location'));
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
