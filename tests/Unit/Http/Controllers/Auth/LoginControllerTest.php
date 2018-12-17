<?php

namespace Tests\Unit\Http\Controllers\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginControllerTest extends TestCase
{
    public function testLoginAdminFunction()
    {
        $data = [
            'email' => 'admin@admin.com',
            'password' => 'admin@123',
        ];

        $login = $this->post(route('login'), $data);
        $login->assertRedirect(route('admin.index'));
    }
}
