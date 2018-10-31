<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
        <div class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_job_post_side_img">
                        <img class="img-responsive" src="{{ asset(config('app.client_media_url') . $job['company_logo']) }}" alt="post_img">
                    </div>
                    <div class="jp_job_post_right_cont jp_job_post_grid_right_cont">
                        <h4 class="text-dark"><a href="{{ route('jobs.detail', ['id' => $job['job']->id]) }}">{{ $job['job']->title }}</a></h4>
                        <p>
                        <h4><a href="{{ route('companies.show',  $job['token']) }}">{{ $job['company_name'] }}</a></h4>
                        </p>
                        <ul>
                            <li>
                                <i class="fa fa-usd"></i>&nbsp;
                                {{ number_format($job['job']->salary_min) . ' - ' . number_format($job['job']->salary_max) }}
                            </li>
                            <li>
                                <i class="fa fa-map-marker"></i>&nbsp; {{ $job['job']->locationJobs->name }}
                            </li>
                            <li>
                                <i class="fa fa-hashtag"></i>&nbsp;
                                {{ $job['job']->experience }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_job_post_right_btn_wrapper jp_job_post_grid_right_btn_wrapper">
                        <ul class="pull-right">
                            <li></li>
                            <li><a href="#">{{ $job['job']->jobTypeJobs->name }}</a></li>
                            <li>
                                <a href="{{ route('jobs.detail', ['id' => $job['job']->id]) }}"> {{ __('Detail') }}</a>
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
