<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;
use App\Models\Category;

class CategoryControllerTest extends TestCase
{
    const TABLE = 'categories';

    protected  $admin = [
        'email' => 'admin@admin.com',
        'password' => 'admin@123',
    ];


    public function testIndexFunction()
    {
        $this->login($this->admin);
        $response = $this->get(route('categories.index'));
        $response->assertViewIs('admin.categories.index');
        $response->assertViewHas('categories');
        $response->assertSuccessful();
    }

    public function testCreateCategory()
    {
        $category = [
            'name' => 'IT dddddddd',
            'description' => 'phanmemddddd',
            'parent_id' => 0,
        ];
        $this->login($this->admin);
        $response = $this->json('POST', route('categories.store'), $category);
        $this->assertDatabaseHas(self::TABLE, $category);
        $response->assertRedirect(route('categories.index'));
    }

    public function testUpdateCategory()
    {
        $category = factory(Category::class)->create();
        $this->login($this->admin);

        $data = [
            'name' => 'Tài chính - Ngân Hàng',
            'description' => 'Nghiêp vụ tài chính kinh tế',
            'parent_id' => 0,
        ];
        $response = $this->json('PUT', route('categories.update', $category->id), $data);
        $this->assertDatabaseHas(self::TABLE, $data);
        $response->assertRedirect(route('categories.index'));
    }

    public function testDeleteCategory()
    {
        $this->login($this->admin);
        $category = factory(Category::class)->create();
        $response = $this->json('DELETE', route('categories.destroy', $category->id));
        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseMissing(self::TABLE, $category->toArray());
    }

    public function testValidateCreateCategory()
    {
        $category = [
            'name' => 'IT ',
            'description' => 'phan',
            'parent_id' => 0,
        ];
        $this->login($this->admin);
        $response = $this->json('POST', route('categories.store'), $category);
        $this->assertSame('The given data was invalid.', $response->json('message'));
        $this->assertDatabaseMissing(self::TABLE, $category);
    }
}
