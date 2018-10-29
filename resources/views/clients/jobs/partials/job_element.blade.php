<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
        <div class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_job_post_side_img">
                        <img src="#" alt="post_img">
                    </div>
                    <div class="jp_job_post_right_cont jp_job_post_grid_right_cont">
                        <h3>{{ $job['job']->title }}</h3>
                        <p>{{ $job['job']->jobTypeJobs->name }}</p>
                        <ul>
                            <li><i class="fa fa-cc-paypal"></i>&nbsp; {{ $job['job']->salary_min . ' - ' . $job['job']->salary_max }}</li>
                            <li><i class="fa fa-map-marker"></i>&nbsp; {{ $job['job']->locationJobs->name }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_job_post_right_btn_wrapper jp_job_post_grid_right_btn_wrapper">
                        <ul class="pull-right">
                            <li></li>
                            <li><a class="">{{ __('Edit') }}</a></li>
                            <li>
                                {{ Form::open([ 'method' =>'delete', 'url' => route('jobs.destroy', $job['job']->id) ]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
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
