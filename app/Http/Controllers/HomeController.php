<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Repositories\Interfaces\RoleRepository;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LocationRepository;
use App\Repositories\Interfaces\SkillRepository;
use App\Repositories\Interfaces\CategoryRepository;
use phpDocumentor\Reflection\Location;
use App\Repositories\Interfaces\JobRepository;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    private $location;
    private $skill;
    private $category;
    private const RECORD_PER_PAGE = 10;
    private $jobRepository;
    private $userRepository;
    private $roleRepository;

    public function __construct(
        LocationRepository $locationRepository,
        SkillRepository $skillRepository,
        CategoryRepository $categoryRepository,
        JobRepository $jobRepository,
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ) {
        $this->location = $locationRepository;
        $this->skill = $skillRepository;
        $this->category = $categoryRepository;
        $this->jobRepository = $jobRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $activeCompanies = $this->jobRepository->getAllActiveCompany();
        $categories = $this->category->getAllWithOutPaginate();
        $jobs = $this->jobRepository->getAllAvailableJob(self::RECORD_PER_PAGE, $activeCompanies);
        $location = $this->location->getAllWithOutPaginate();

        return view('clients.index', compact('location', 'jobs', 'categories'));
    }

    public function redirectToHome()
    {
        return redirect()->route('home.index');
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
        }

        return response()->json($data);
    }
}
