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
                            <h4>{{ $jobDetail['job']->title }}</h4>
                            <p>
                            <h5><a href="{{ route('companies.show', $jobDetail['token']) }}">{{ $jobDetail['company_name'] }}</a></h5>
                            </p>
                            <ul>
                                <li>
                                    <i class="fa fa-usd"></i>&nbsp; {{ number_format($jobDetail['job']->salary_min) . ' - ' . number_format($jobDetail['job']->salary_max) }}
                                </li>
                                <li>
                                    <i class="fa fa-map-marker"></i>&nbsp; {{ $jobDetail['job']->locationJobs->name }}
                                </li>
                                <li>
                                    <i class="fa fa-hashtag"></i>&nbsp;
                                    {{ $jobDetail['job']->experience }}
                                </li>
                                <li>
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    {{ date('d - m - Y', strtotime($jobDetail['job']->out_date)) }}
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
                                    <li><a href="#">{{ $jobDetail['job']->jobTypeJobs->name }}</a></li>
                                    @if ($jobDetail['can_apply'])
                                        <li>
                                            <a href="{{ route('applications.create', ['id' => $jobDetail['job']->id]) }}">
                                                {{ __('Apply') }}
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="#" class="disabled_button" onclick="return false">
                                                {{ __('Applied') }}
                                            </a>
                                        </li>
                                    @endif
                                @elseif ($jobDetail['role_name'] == config('app.company_role') && Auth::user()->can('update', $jobDetail['job']))
                                    <li></li>
                                    <li>
                                        <a href="{{ route('jobs.edit', ['id' => $jobDetail['job']->id]) }}">
                                            {{ __('Edit') }}
                                        </a>
                                    </li>
                                    <li>
                                        @include('elements.button_model', ['nameRoute' => 'jobs.destroy', 'data' => $jobDetail['job']])
                                    </li>
                                @elseif ($jobDetail['role_name'] == config('app.guest_role'))
                                    <li></li>
                                    <li><a href="#">{{ $jobDetail['job']->jobTypeJobs->name }}</a></li>
                                    @if ($jobDetail['can_apply'])
                                        <li>
                                            <a href="{{ route('applications.create', ['id' => $jobDetail['job']->id]) }}">
                                                {{ __('Apply') }}
                                            </a>
                                        </li>
                                    @endif
                                @else
                                    <li></li>
                                    <li><a href="#">{{ $jobDetail['job']->jobTypeJobs->name }}</a></li>
                                    <li></li>
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
