<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
        <div class="jp_job_post_main_wrapper">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="jp_job_post_side_img">
                        <img class="img-responsive" src="{{ asset(config('app.client_media_url') . $job['company_logo']) }}" alt="post_img">
                    </div>
                    <div class="jp_job_post_right_cont">
                        <h4 class="text-dark"><a href="{{ route('jobs.detail', ['id' => $job['job']->id]) }}">{{ $job['job']->title }}</a></h4>
                        <p>
                        <h4><a href="{{ route('companies.show',  $job['token']) }}">{{ $job['company_name'] }}</a></h4>
                        </p>
                        <ul>
                            <ul>
                                <li></li>
                                <li>
                                    <span class="job_detail_text">{{ __('Salary:') }}&nbsp; </span>
                                    {{ '$ ' . number_format($job['job']->salary_min) . ' - $ ' . number_format($job['job']->salary_max) }}
                                </li>
                                <li>
                                    <span class="job_detail_text">{{ __('Location:') }}&nbsp;</span>
                                    {{ $job['job']->locationJobs->name }}
                                </li>
                                <li>
                                    <span class="job_detail_text">{{ __('Experience:') }}&nbsp;</span>
                                    {{ $job['job']->experience }}
                                </li>
                                <li>
                                    <span class="job_detail_text">{{ __('Job closing on:') }}&nbsp;</span>
                                    {{ date('d - m - Y', strtotime($job['job']->out_date)) }}
                                </li>
                                <li>
                                    <span class="job_detail_text">{{ __('Job Type:') }}&nbsp;</span>
                                    {{ $job['job']->jobTypeJobs->name }}
                                </li>
                                <li>
                                    @if ($job['job']->candidate_number != null)
                                        <span class="job_detail_text">{{ __('Candidate Number:') }}&nbsp;</span>
                                        {{ $job['job']->candidate_number }}
                                    @endif
                                </li>
                                <li>
                                    @foreach($job['skills'] as $skill)
                                        <span class="label label-info">{{ $skill }}</span>
                                    @endforeach
                                </li>
                            </ul>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="jp_job_post_right_btn_wrapper">
                        <ul>
                            <li></li>
                            <li>
                                <a href="{{ route('jobs.detail', ['id' => $job['job']->id]) }}"> {{ __('Detail') }}</a>
                            </li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="jp_job_post_keyword_wrapper">
            @foreach ($job['skills'] as $skill)
                <span class="label label-info">{{ $skill }}</span>
            @endforeach
        </div>
    </div>
</div>
