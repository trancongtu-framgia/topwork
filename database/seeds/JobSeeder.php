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
                'description' => '<p>LG Electronics Vehicle Component Company focuses on eco-friendly automotive components. The VC Company produces high-quality in-car infotainment systems that deliver both information and entertainment on-the-go for many of the world&lsquo;s biggest automobile brands.<br />
                                    <br />
                                    We, LG Electronics Development Center Vietnam (VC DCV), conduct core R&amp;D activities, and various product reliability tests in support of our vehicle component business.<br />
                                    <br />
                                    As member of Software Development team, you will be responsible for researching and developing applications for Car Infotainment, AVN (Audio Video Navigation) system, Cluster and Telematics as below:<br />
                                    <br />
                                    &bull; Develop automotive products and technologies (included HMI Applications, HMI frameworks, Protocols to interface with HMI framework and middleware &hellip;);<br />
                                    &bull; Responsible for software delivery to head quarter;<br />
                                    &bull; Generate reports, communicate with local managements and head quarter.</p>',
                'job_type_id' => 1,
                'location_id' => 1,
                'experience' => 'Không cần kinh nghiệm',
                'out_date' => '2018-12-05',
            ],
            [
                'user_id' => 2,
                'title' => 'develop JAVA',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '<p>LG Electronics Vehicle Component Company focuses on eco-friendly automotive components. The VC Company produces high-quality in-car infotainment systems that deliver both information and entertainment on-the-go for many of the world&lsquo;s biggest automobile brands.<br />
                                    <br />
                                    We, LG Electronics Development Center Vietnam (VC DCV), conduct core R&amp;D activities, and various product reliability tests in support of our vehicle component business.<br />
                                    <br />
                                    As member of Software Development team, you will be responsible for researching and developing applications for Car Infotainment, AVN (Audio Video Navigation) system, Cluster and Telematics as below:<br />
                                    <br />
                                    &bull; Develop automotive products and technologies (included HMI Applications, HMI frameworks, Protocols to interface with HMI framework and middleware &hellip;);<br />
                                    &bull; Responsible for software delivery to head quarter;<br />
                                    &bull; Generate reports, communicate with local managements and head quarter.</p>',
                'job_type_id' => 2,
                'location_id' => 1,
                'experience' => '6 Tháng kinh nghiệm',
                'out_date' => '2018-12-05',
            ],
            [
                'user_id' => 3,
                'title' => 'Lap trinh C#',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '<p>LG Electronics Vehicle Component Company focuses on eco-friendly automotive components. The VC Company produces high-quality in-car infotainment systems that deliver both information and entertainment on-the-go for many of the world&lsquo;s biggest automobile brands.<br />
                                    <br />
                                    We, LG Electronics Development Center Vietnam (VC DCV), conduct core R&amp;D activities, and various product reliability tests in support of our vehicle component business.<br />
                                    <br />
                                    As member of Software Development team, you will be responsible for researching and developing applications for Car Infotainment, AVN (Audio Video Navigation) system, Cluster and Telematics as below:<br />
                                    <br />
                                    &bull; Develop automotive products and technologies (included HMI Applications, HMI frameworks, Protocols to interface with HMI framework and middleware &hellip;);<br />
                                    &bull; Responsible for software delivery to head quarter;<br />
                                    &bull; Generate reports, communicate with local managements and head quarter.</p>',
                'job_type_id' => 2,
                'location_id' => 3,
                'experience' => '2 Years',
                'out_date' => '2018-11-05',
            ],
            [
                'user_id' => 3,
                'title' => 'Lập trình .NET',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '<p>LG Electronics Vehicle Component Company focuses on eco-friendly automotive components. The VC Company produces high-quality in-car infotainment systems that deliver both information and entertainment on-the-go for many of the world&lsquo;s biggest automobile brands.<br />
                                    <br />
                                    We, LG Electronics Development Center Vietnam (VC DCV), conduct core R&amp;D activities, and various product reliability tests in support of our vehicle component business.<br />
                                    <br />
                                    As member of Software Development team, you will be responsible for researching and developing applications for Car Infotainment, AVN (Audio Video Navigation) system, Cluster and Telematics as below:<br />
                                    <br />
                                    &bull; Develop automotive products and technologies (included HMI Applications, HMI frameworks, Protocols to interface with HMI framework and middleware &hellip;);<br />
                                    &bull; Responsible for software delivery to head quarter;<br />
                                    &bull; Generate reports, communicate with local managements and head quarter.</p>',
                'job_type_id' => 2,
                'location_id' => 2,
                'experience' => '1 Year',
                'out_date' => '2018-12-05',
            ],
            [
                'user_id' => 2,
                'title' => 'Tuyển nhân viên kỹ thuật',
                'salary_min' => 150,
                'salary_max' => 1000,
                'description' => '<p>LG Electronics Vehicle Component Company focuses on eco-friendly automotive components. The VC Company produces high-quality in-car infotainment systems that deliver both information and entertainment on-the-go for many of the world&lsquo;s biggest automobile brands.<br />
                                    <br />
                                    We, LG Electronics Development Center Vietnam (VC DCV), conduct core R&amp;D activities, and various product reliability tests in support of our vehicle component business.<br />
                                    <br />
                                    As member of Software Development team, you will be responsible for researching and developing applications for Car Infotainment, AVN (Audio Video Navigation) system, Cluster and Telematics as below:<br />
                                    <br />
                                    &bull; Develop automotive products and technologies (included HMI Applications, HMI frameworks, Protocols to interface with HMI framework and middleware &hellip;);<br />
                                    &bull; Responsible for software delivery to head quarter;<br />
                                    &bull; Generate reports, communicate with local managements and head quarter.</p>',
                'job_type_id' => 1,
                'location_id' => 1,
                'experience' => 'Không cần kinh nghiệm',
                'out_date' => '2018-12-05',
            ],
            [
                'user_id' => 3,
                'title' => 'Tuyển nhân viên lập trình',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '<p>LG Electronics Vehicle Component Company focuses on eco-friendly automotive components. The VC Company produces high-quality in-car infotainment systems that deliver both information and entertainment on-the-go for many of the world&lsquo;s biggest automobile brands.<br />
                                    <br />
                                    We, LG Electronics Development Center Vietnam (VC DCV), conduct core R&amp;D activities, and various product reliability tests in support of our vehicle component business.<br />
                                    <br />
                                    As member of Software Development team, you will be responsible for researching and developing applications for Car Infotainment, AVN (Audio Video Navigation) system, Cluster and Telematics as below:<br />
                                    <br />
                                    &bull; Develop automotive products and technologies (included HMI Applications, HMI frameworks, Protocols to interface with HMI framework and middleware &hellip;);<br />
                                    &bull; Responsible for software delivery to head quarter;<br />
                                    &bull; Generate reports, communicate with local managements and head quarter.</p>',
                'job_type_id' => 2,
                'location_id' => 1,
                'experience' => '6 Tháng kinh nghiệm',
                'out_date' => '2018-12-05',
            ],
            [
                'user_id' => 3,
                'title' => 'Nhân sự phòng kỹ thuật',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '<p>LG Electronics Vehicle Component Company focuses on eco-friendly automotive components. The VC Company produces high-quality in-car infotainment systems that deliver both information and entertainment on-the-go for many of the world&lsquo;s biggest automobile brands.<br />
                                    <br />
                                    We, LG Electronics Development Center Vietnam (VC DCV), conduct core R&amp;D activities, and various product reliability tests in support of our vehicle component business.<br />
                                    <br />
                                    As member of Software Development team, you will be responsible for researching and developing applications for Car Infotainment, AVN (Audio Video Navigation) system, Cluster and Telematics as below:<br />
                                    <br />
                                    &bull; Develop automotive products and technologies (included HMI Applications, HMI frameworks, Protocols to interface with HMI framework and middleware &hellip;);<br />
                                    &bull; Responsible for software delivery to head quarter;<br />
                                    &bull; Generate reports, communicate with local managements and head quarter.</p>',
                'job_type_id' => 2,
                'location_id' => 3,
                'experience' => '2 Years',
                'out_date' => '2018-11-05',
            ],
            [
                'user_id' => 3,
                'title' => 'PHP,asp.net',
                'salary_min' => 350,
                'salary_max' => 750,
                'description' => '<p>LG Electronics Vehicle Component Company focuses on eco-friendly automotive components. The VC Company produces high-quality in-car infotainment systems that deliver both information and entertainment on-the-go for many of the world&lsquo;s biggest automobile brands.<br />
                                    <br />
                                    We, LG Electronics Development Center Vietnam (VC DCV), conduct core R&amp;D activities, and various product reliability tests in support of our vehicle component business.<br />
                                    <br />
                                    As member of Software Development team, you will be responsible for researching and developing applications for Car Infotainment, AVN (Audio Video Navigation) system, Cluster and Telematics as below:<br />
                                    <br />
                                    &bull; Develop automotive products and technologies (included HMI Applications, HMI frameworks, Protocols to interface with HMI framework and middleware &hellip;);<br />
                                    &bull; Responsible for software delivery to head quarter;<br />
                                    &bull; Generate reports, communicate with local managements and head quarter.</p>',
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
            [
                'job_id' => 5,
                'category_id' => 1,
            ],
            [
                'job_id' => 6,
                'category_id' => 1,
            ],
            [
                'job_id' => 7,
                'category_id' => 2,
            ],
            [
                'job_id' => 8,
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
            [
                'job_id' => 3,
                'skill_id' => 1,
            ],
            [
                'job_id' => 3,
                'skill_id' => 2,
            ],
            [
                'job_id' => 3,
                'skill_id' => 3,
            ],
            [
                'job_id' => 4,
                'skill_id' => 1,
            ],
            [
                'job_id' => 4,
                'skill_id' => 3,
            ],
            [
                'job_id' => 4,
                'skill_id' => 4,
            ],
            [
                'job_id' => 4,
                'skill_id' => 5,
            ],
            [
                'job_id' => 5,
                'skill_id' => 1,
            ],
            [
                'job_id' => 5,
                'skill_id' => 2,
            ],
            [
                'job_id' => 5,
                'skill_id' => 3,
            ],
            [
                'job_id' => 6,
                'skill_id' => 1,
            ],
            [
                'job_id' => 6,
                'skill_id' => 3,
            ],
            [
                'job_id' => 6,
                'skill_id' => 4,
            ],
            [
                'job_id' => 6,
                'skill_id' => 5,
            ],
            [
                'job_id' => 7,
                'skill_id' => 1,
            ],
            [
                'job_id' => 7,
                'skill_id' => 2,
            ],
            [
                'job_id' => 7,
                'skill_id' => 3,
            ],
            [
                'job_id' => 8,
                'skill_id' => 1,
            ],
            [
                'job_id' => 8,
                'skill_id' => 3,
            ],
            [
                'job_id' => 8,
                'skill_id' => 4,
            ],
            [
                'job_id' => 8,
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
