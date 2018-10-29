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
        $typeJob = [
            'Full-time',
            'Part-time',
        ];

        $locationItime = [
            'Ha Noi',
            'Da Nang',
            'Ho Chi Minh',
        ];

        $categories = [
            'Graphic Designer',
            'Engineering Jobs',
            'IT Jobs',
        ];

        $skills = [
            [
                'name' => 'PHP',
                'category_id' => 3
            ],
            [
                'name' => 'Java',
                'category_id' => 3
            ],
            [
                'name' => 'C#',
                'category_id' => 2
            ],
            [
                'name' => 'C.Net',
                'category_id' => 1
            ],
            [
                'name' => 'Python',
                'category_id' => 2
            ],

        ];

        $jobItime = [
            [
                'user_id' => 2,
                'title' => 'Lập trình PHP',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '',
                'job_type_id' => 1,
                'location_id' => 1,
                'experience' => 'Không cần kinh nghiệm',
                'out_date' => '2018-06-05',
            ],
            [
                'user_id' => 2,
                'title' => 'develop JAVA',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '',
                'job_type_id' => 2,
                'location_id' => 1,
                'experience' => '6 Tháng kinh nghiệm',
                'out_date' => '2018-12-05',
            ],
            [
                'user_id' => 2,
                'title' => 'Lap trinh C#',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '',
                'job_type_id' => 2,
                'location_id' => 3,
                'experience' => '2 Years',
                'out_date' => '2018-11-05',
            ],
            [
                'user_id' => 2,
                'title' => 'Lập trình .NET',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '',
                'job_type_id' => 2,
                'location_id' => 2,
                'experience' => '1 Year',
                'out_date' => '2018-12-05',
            ],

        ];

        $jobCategory = [
            [
                'job_id' => 1,
                'category_id' => 1,
            ],
            [
                'job_id' => 2,
                'category_id' => 1,
            ],
            [
                'job_id' => 3,
                'category_id' => 2,
            ],
            [
                'job_id' => 4,
                'category_id' => 3,
            ],
        ];

        $jobSkills = [
            [
                'job_id' => 1,
                'skill_id' => 1,
            ],
            [
                'job_id' => 1,
                'skill_id' => 2,
            ],
            [
                'job_id' => 1,
                'skill_id' => 3,
            ],
            [
                'job_id' => 2,
                'skill_id' => 1,
            ],
            [
                'job_id' => 2,
                'skill_id' => 3,
            ],
            [
                'job_id' => 2,
                'skill_id' => 4,
            ],
            [
                'job_id' => 2,
                'skill_id' => 5,
            ],
        ];

        DB::beginTransaction();
        try {
            foreach ($typeJob as $item) {
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

            foreach ($categories as $cat) {
                $category = new \App\Models\Category();
                $category->name = $cat;
                $category->save();
            }

            foreach ($skills as $skill) {
                \App\Models\Skill::create($skill);
            }

            foreach ($jobItime as $job) {
                \App\Models\Job::create($job);
            }

            foreach ($jobCategory as $jobcate) {
                \App\Models\JobCategory::create($jobcate);
            }

            foreach ($jobSkills as $jobSkill) {
                \App\Models\JobSkill::create($jobSkill);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $e;
        }
    }
}
