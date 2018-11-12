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
        $jobs = $this->getJob();
        $categories = $this->category->getAllWithOutPaginate();
        $location = $this->location->getAllWithOutPaginate();
        $route = 'home';

        return view('clients.index', compact('location', 'jobs', 'categories', 'route'));
    }

    public function getJob()
    {
        $activeCompanies = $this->jobRepository->getAllActiveCompany();
        $jobs = $this->jobRepository->getAllAvailableJob(self::RECORD_PER_PAGE, $activeCompanies);

        return $jobs;
    }

    public function getJobByPaginate()
    {
        $jobs = $this->getJob();
        $route = 'home';

        return view('clients.home.partials.contentShowJobs', compact('jobs', 'route'));
    }

    public function redirectToHome()
    {
        return redirect()->route('home.index');
    }

    public function search(Request $request)
    {
        $jobs = $this->jobRepository->searchJob($request->keyword, $request->location, self::RECORD_PER_PAGE, $request->fullUrl());
        $location = $this->location->getAllWithOutPaginate();
        $route = 'search';
        if (isset($request->paginateAjax)) {
            return view('clients.home.partials.contentShowJobs', compact('jobs', 'route'));
        }

        return view('clients.home.search', compact('jobs', 'location', 'route'));
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
