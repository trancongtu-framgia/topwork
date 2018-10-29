<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([AdminSeeder::class, UserSeeder::class]);
         $this->call([AdminSeeder::class, UserSeeder::class]);
         $this->call(CandidateTableSeeder::class);
         $this->call(JobTableSeeder::class);
         $this->call(ApplicationTableSeeder::class);
    }
}
