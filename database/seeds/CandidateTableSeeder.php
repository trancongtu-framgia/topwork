<?php

use Illuminate\Database\Seeder;
use App\Models\Candidate;

class CandidateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Candidate::class, 50)->create();
    }
}
