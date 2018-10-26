<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::beginTransaction();
        try {
            $typeJob = [
                'Full-time',
                'Part-time',
            ];

            $locationItime = [
                'Ha Noi',
                'Da Nang',
                'Ho Chi Minh',
            ];

            foreach ($typeJob as $item ) {
                $jobType = new \App\Models\JobType();
                $jobType->name = $item;
                $jobType->description = 'sss';
                $jobType->save();
            }

            foreach ($locationItime as $row) {
                $location = new \App\Models\Location();
                $location->name = $row;
                $location->save();

            }
            $jobItime = [
                [
                    'user_id' => 2,
                    'title' => 'PHP',
                    'salary_min' => 350,
                    'salary_max' => 750,
                    'description' => '',
                    'job_type_id' => 1,
                    'location_id' => 1,
                    'experience' => '2018-06-05',
                    'out_date' => '2018-06-05',
                ],
                [
                    'user_id' => 2,
                    'title' => 'JAVA',
                    'salary_min' => 350,
                    'salary_max' => 750,
                    'description' => '',
                    'job_type_id' => 2,
                    'location_id' => 1,
                    'experience' => '2018-06-05',
                    'out_date' => '2018-06-05',
                ],
                [
                    'user_id' => 2,
                    'title' => 'C#',
                    'salary_min' => 350,
                    'salary_max' => 750,
                    'description' => '',
                    'job_type_id' => 2,
                    'location_id' => 3,
                    'experience' => '2018-06-05',
                    'out_date' => '2018-06-05',
                ],
                [
                    'user_id' => 2,
                    'title' => '.NET',
                    'salary_min' => 350,
                    'salary_max' => 750,
                    'description' => '',
                    'job_type_id' => 2,
                    'location_id' => 2,
                    'experience' => '2018-06-05',
                    'out_date' => '2018-06-05',
                ],

            ];

            foreach ( $jobItime as $job ) {
                \App\Models\Job::create($job);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $e;
        }
    }
}
