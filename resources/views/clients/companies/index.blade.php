@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('Company Profile') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Company Profile') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
<div class="mt-35 col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="jp_listing_left_sidebar_wrapper">
        <div class="jp_job_des">
            <h2>{{ __('Company Description') }}</h2>
            <p>{!! $company['description'] !!}</p>
        </div>
    </div>

    @if (isset($relatedJobs))
        <div class="mt-35 jp_job_des">
            <h2>{{ __('Related Jobs') }}</h2>
        </div>
        @foreach ($relatedJobs as $job)
            @include('clients.home.partials.job_element_retangle')
        @endforeach
    @endif
</div>

<div class="mt-35 col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
        <div class="jp_rightside_job_categories_heading">
            <h4>{{ __('Company Overview') }}</h4>
        </div>
        <div class="jp_jop_overview_img_wrapper">
            <div class="jp_jop_overview_img">
                <img class="img-responsive" src="{{ asset(config('app.client_media_url') . $company['logo']) }}" alt="post_img">
            </div>
        </div>
        <div class="jp_job_listing_single_post_right_cont">
            <div class="jp_job_listing_single_post_right_cont_wrapper">
                <h3><a href="{{ route('companies.show', $company['token']) }}">{{ $company['name'] }}</a></h3>
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
                        <li>{{ $company['country'] }}</li>
                    </ul>
                </div>
                <div class="jp_listing_list_icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="jp_listing_list_icon_cont_wrapper">
                    <ul>
                        <li>{{ __('Range') }}</li>
                        <li>{{ $company['range'] }}</li>
                    </ul>
                </div>
                <div class="jp_listing_list_icon">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="jp_listing_list_icon_cont_wrapper">
                    <ul>
                        <li>{{ __('Working Day') }}</li>
                        <li>{{ $company['working_day'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

