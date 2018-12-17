<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{

    public function testIndexFunction()
    {
        $response = $this->get('/');
        $response->assertViewIs('clients.index');
        $response->assertSeeText('Many Jobs are waiting for you !');
        $response->assertSeeText('Home');
        $response->assertSeeText('Do IT Awesome !');
        $response->assertSeeText('Jobs by Category');
        $response->assertDontSeeText('Compjddddddddddds');
        $response->assertViewHas('location');
        $response->assertViewHas('categories');
        $response->assertViewHas('route');
        $response->assertViewHas('jobs');
        $response->assertSuccessful();
    }

    public function testRedirectHomeFunction()
    {
        $response = $this->get('/home');
        $response->assertRedirect(route('home.index'));
    }

    public function testGetJobByPaginateFunction()
    {
        $response = $this->get(route('home.getJobByPaginate'));
        $response->assertViewIs('clients.home.partials.contentShowJobs');
        $response->assertViewHas('jobs');
        $response->assertViewHas('route');
        $response->assertSuccessful();
    }

    public function testSearchJobFunctionWithoutPaginate()
    {
        $response = $this->get(route('home.search'));
        $response->assertViewIs('clients.home.search');
        $response->assertViewHas('jobs');
        $response->assertViewHas('location');
        $response->assertViewHas('route');
        $response->assertSuccessful();
    }

    public function testSearchJobFunctionWithPaginate()
    {
        $data = [
            'paginateAjax' => '2',
        ];
        $response = $this->get(route('home.search', $data));
        $response->assertViewIs('clients.home.partials.contentShowJobs');
        $response->assertViewHas('jobs');
        $response->assertViewHas('route');
        $response->assertSuccessful();
    }
}
