<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
        <div class="jp_job_post_main_wrapper">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="jp_job_post_side_img">
                        <img src="#" alt="post_img">
                    </div>
                    <div class="jp_job_post_right_cont">
                        <h4>{{ $job['job']->title }}</h4>
                        <p>
                            <h5>{{ $job['company_name'] }}</h5>
                        </p>
                        <ul>
                            <li>
                                <i class="fa fa-usd"></i>&nbsp;
                                {{ number_format($job['job']->salary_min) . ' - ' . number_format($job['job']->salary_max) }}
                            </li>
                            <li>
                                <i class="fa fa-map-marker"></i>&nbsp;
                                {{ $job['job']->locationJobs->name }}
                            </li>
                            <li>
                                <i class="fa fa-calendar"></i>&nbsp;
                                {{ date('d - m - Y', strtotime($job['job']->out_date)) }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="jp_job_post_right_btn_wrapper">
                        <ul>
                            <li></li>
                            <li>
                                <a href="#">{{ $job['job']->jobTypeJobs->name }}</a>
                            </li>
                            <li>
                                <a href="{{ route('applications.create', ['id' => $job['job']->id]) }}">{{ __('Apply') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="jp_job_post_keyword_wrapper">
            @foreach($job['skills'] as $skill)
                <span class="label label-info">{{ $skill }}</span>
            @endforeach
        </div>
    </div>
</div>
