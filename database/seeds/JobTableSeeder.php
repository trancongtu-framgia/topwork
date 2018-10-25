<?php

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Job::class, 4)->create();
    }
}
