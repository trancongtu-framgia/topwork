<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Location;

class LocationControllerTest extends TestCase
{
    const TABLE = 'locations';
    protected  $admin = [
        'email' => 'admin@admin.com',
        'password' => 'admin@123',
    ];

    public function testIndexFunction()
    {
        $this->login($this->admin);
        $response = $this->get(route('locations.index'));
        $response->assertViewIs('admin.locations.index');
        $response->assertViewHas('locations');
        $response->assertSuccessful();
    }

    public function testCreateLocation()
    {
        $this->login($this->admin);
        $location = [
            'name' => 'Ha tinh',
        ];
        $response = $this->json('POST', route('locations.store'), $location);
        $response->assertRedirect(route('locations.index'));
        $this->assertDatabaseHas(self::TABLE, $location);
    }

    public function testUpdateLocation()
    {
        $this->login($this->admin);
        $location = factory(Location::class)->create();
        $data = [
            'name' => 'Thai Lo'
        ];
        $response = $this->json('PUT', route('locations.update', $location->id), $data);
        $response->assertRedirect(route('locations.index'));
        $this->assertDatabaseHas(self::TABLE, $data);
    }

    public function testDeleteLocation()
    {
        $this->login($this->admin);
        $location = factory(Location::class)->create();
        $response = $this->json('DELETE', route('locations.destroy', $location->id));
        $response->assertRedirect(route('locations.index'));
        $this->assertDatabaseMissing(self::TABLE, $location->toArray());
    }
}
