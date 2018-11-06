@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('Job Detail') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Job Detail') }}</li>
    </ul>
@endsection
    @include('clients.layouts.breadcrumb')
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
            <div class="mt-0 jp_job_post_main_wrapper">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="jp_job_post_side_img">
                            <img class="img-responsive" src="{{ asset(config('app.client_media_url') . $jobDetail['company_logo']) }}" alt="post_img">
                        </div>
                        <div class="jp_job_post_right_cont">
                            {{ Form::hidden('job_id', $jobDetail['job']->id, ['id' => 'hidden_job_id']) }}                            <h3>{{ $jobDetail['job']->title }}</h3>
                            <p>
                            <h5><a href="{{ route('companies.show', $jobDetail['token']) }}">{{ $jobDetail['company_name'] }}</a></h5>
                            </p>
                            <ul>
                                <li></li>
                                <li>
                                    {{ __('Salary:') }}&nbsp; {{ '$ ' . number_format($jobDetail['job']->salary_min) . ' - $ ' . number_format($jobDetail['job']->salary_max) }}
                                </li>
                                <li>
                                    {{ __('Location:') }}&nbsp; {{ $jobDetail['job']->locationJobs->name }}
                                </li>
                                <li>
                                    {{ __('Experience:') }}&nbsp;
                                    {{ $jobDetail['job']->experience }}
                                </li>
                                <li>
                                    {{ __('Job closing on:') }}&nbsp;
                                    {{ date('d - m - Y', strtotime($jobDetail['job']->out_date)) }}
                                </li>
                                <li>
                                    {{ __('Job Type:') }}&nbsp;
                                    {{ $jobDetail['job']->jobTypeJobs->name }}
                                </li>
                                <li>
                                    @if ($jobDetail['job']->candidate_number != null)
                                        {{ __('Candidate Number:') }}&nbsp;
                                        {{ $jobDetail['job']->candidate_number }}
                                    @endif
                                </li>

                                <li>
                                    @foreach($jobDetail['skills'] as $skill)
                                        <span class="label label-info">{{ $skill }}</span>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="jp_job_post_right_btn_wrapper">
                            <ul>
                                @if ($jobDetail['role_name'] == config('app.candidate_role'))
                                    <li></li>
                                    @if ($jobDetail['can_apply'] && $jobDetail['job']->is_available == true)
                                        <li>
                                            <a href="{{ route('applications.create', ['id' => $jobDetail['job']->id]) }}">
                                                {{ __('Apply') }}
                                            </a>
                                        </li>
                                    @elseif (!$jobDetail['can_apply'])
                                        <li>
                                            <a href="#" class="disabled_button" onclick="return false">
                                                {{ __('Applied') }}
                                            </a>
                                        </li>
                                    @elseif (!$jobDetail['job']->is_available)
                                        <li>
                                            <a href="#" class="disabled_button" onclick="return false">
                                                {{ __('Job closed') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li></li>
                                @elseif ($jobDetail['role_name'] == config('app.company_role') && Auth::user()->can('update', $jobDetail['job']))
                                    <li></li>
                                    <li>
                                        <a class="with-60" href="{{ route('jobs.edit', ['id' => $jobDetail['job']->id]) }}">
                                            {{ __('Edit') }}
                                        </a>
                                    </li>
                                    <li>
                                        <label id="open_job">{{ __('Public') }}</label><br>
                                        <label class="switch">
                                            {{ Form::checkbox('is_available', true,
                                                $jobDetail['job']->is_available == 0 ? false : true,
                                                ['onchange' => 'changeJobStatus(\'' . config('app.locale') . '\', \''.__('Update'). '\')'])
                                            }}
                                            <span class="slider round"></span>
                                        </label>
                                    </li>
                                @elseif ($jobDetail['role_name'] == config('app.guest_role'))
                                    <li></li>
                                    @if ($jobDetail['can_apply'])
                                        <li>
                                            <a href="{{ route('applications.create', ['id' => $jobDetail['job']->id]) }}">
                                                {{ __('Apply') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li></li>
                                @elseif ($jobDetail['role_name'] == config('app.admin_role'))
                                    <li></li>
                                    <li></li>
                                    <li>
                                        @include('elements.button_model', ['nameRoute' => 'jobs.destroy', 'data' => $jobDetail['job']])
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-5 jp_job_des">
                    <h2>{{ __('Job Description') }}</h2>
                    {!! $jobDetail['job']->description !!}
                </div>
            </div>
            <div class="jp_job_post_keyword_wrapper">
            </div>
        </div>
    </div>
    <div class="mt-35 col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
            <div class="jp_rightside_job_categories_heading">
                <h4>{{ __('Company Overview') }}</h4>
            </div>
            <div class="jp_jop_overview_img_wrapper">
                <div class="jp_jop_overview_img">
                    <img class="img-responsive" src="{{ asset(config('app.client_media_url') . $jobDetail['company_logo']) }}" alt="post_img">
                </div>
            </div>
            <div class="jp_job_listing_single_post_right_cont">
                <div class="jp_job_listing_single_post_right_cont_wrapper">
                    <h3><a href="{{ route('companies.show',  $jobDetail['token']) }}">{{ $jobDetail['company_name'] }}</a></h3>
                </div>
            </div>
            <div class="jp_job_post_right_overview_btn_wrapper">
                <div class="jp_job_post_right_overview_btn">

                </div>
            </div>
            <div class="jp_listing_overview_list_outside_main_wrapper">
                <div class="jp_listing_overview_list_main_wrapper">
                    <div class="jp_listing_list_icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="jp_listing_list_icon_cont_wrapper">
                        <ul>
                            <li>{{ __('Location') }}</li>
                            <li>{{ $company->country }}</li>
                        </ul>
                    </div>
                    <div class="jp_listing_list_icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="jp_listing_list_icon_cont_wrapper">
                        <ul>
                            <li>{{ __('Range') }}</li>
                            <li>{{ $company->range }}</li>
                        </ul>
                    </div>
                    <div class="jp_listing_list_icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="jp_listing_list_icon_cont_wrapper">
                        <ul>
                            <li>{{ __('Working Day') }}</li>
                            <li>{{ $company->working_day }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
