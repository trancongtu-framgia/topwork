@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('Cadidate applied infomation') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li class="set_padding">{{ __('All Applied Candidate') }}<i class="fa fa-angle-right"></i></li>
        <li>{{ __('Cadidate applied infomation') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
    <div class="jp_listing_single_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="jp_listing_left_sidebar_wrapper">
                        <div class="jp_cp_right_side_inner_wrapper">
                            <h2>{{ __('CANDIDATE DETAIL') }}</h2>
                            <div>
                                @if (file_exists(config('app.candidate_media_url') . $user->candidate->avatar_url))
                                    <img class="style_img" src="{{ asset(config('app.candidate_media_url') . $user->candidate->avatar_url) }}" alt="profile_img">
                                @else
                                    <img src="{{ asset(config('app.candidate_media_url') . 'user.png') }}" alt="profile_img">
                                @endif
                            </div>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="td-w25">{{ __('Full Name') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Date of birth') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">{{ $user->candidate->dob }}</td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Address') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">{{ $user->candidate->address }}</td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Phone') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">{{ $user->candidate->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Email') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Experience') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">{{ $user->candidate->experience }}</td>
                                </tr>
                                @if($application)
                                <tr>
                                    <td class="td-w25">{{ __('CV') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        <a href="{{ route('application.download', $application->cv_url) }}">
                                            <input class="btn btn-danger" type="button" value="{{ __('Download') }}">
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="accordion_wrapper abt_page_2_wrapper">
                                    <div class="panel-group" id="accordion_threeLeft">
                                        <div class="panel panel-default">
                                            <div class="panel-heading bell">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion_threeLeft" href="#collapseTwentyLeftThree" aria-expanded="true">{{ __('Profile Detail') }}</a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwentyLeftThree" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                                                <div class="panel-body">
                                                    {!! $user->candidate->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>{{ __('JOB DETAIL') }}</h4>
                                </div>
                                <div class="jp_job_listing_single_post_right_cont">
                                    <div class="jp_job_listing_single_post_right_cont_wrapper">
                                        <h2><a href="{{ route('jobs.detail', $jobs->id) }}">{{ $jobs->title }}</a></h2>
                                        <p>{{ __('Type Job :') . $jobs->jobTypeJobs->name }}</p>
                                    </div>
                                </div>
                                <div class="jp_listing_overview_list_outside_main_wrapper">
                                    <div class="jp_listing_overview_list_main_wrapper">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>{{ __('Location') }}:</li>
                                                <li>{{ $jobs->locationJobs->name }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-info-circle"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>{{ __('Out date') }}:</li>
                                                <li>{{ date('d - m - Y', strtotime($jobs->out_date)) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>{{ __('Range of Salary') }}:</li>
                                                <li>{{ $jobs->salary_min }} - {{ $jobs->salary_max }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>{{ __('Experience Requirement') }}:</li>
                                                <li>{{ $jobs->experience }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 style="padding-top: 5px;">
                                                <i class="fa fa-sticky-note-o set_padding"></i>
                                                {{ __('Note') }}
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-info" onclick="noteApplication('{{ config('app.locale') }}', '{{ __('Update') }}')">
                                                <i class="fa fa-floppy-o"></i> {{ __('Save') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="jp_job_listing_single_post_right_cont">
                                    <div class="jp_job_listing_single_post_right_cont_wrapper">
                                        {{ Form::textarea('note', $application->note,
                                            ['class' => 'form-control',
                                            'id' => 'noteApplicationValue'])
                                        }}
                                        {{ Form::hidden('application', $application->id, ['id' => 'application']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
