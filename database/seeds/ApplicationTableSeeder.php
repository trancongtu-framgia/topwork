<?php

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Application::class, 4)->create();
    }
}
