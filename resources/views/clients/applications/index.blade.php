@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('All Applied Candidate') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li class="set_padding">{{ __('All Applied Candidate') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
    <div class="jp_cp_profile_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>{{ __('Candidate By Job') }}</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                @foreach ($jobs as $key => $job)
                                                    @if ($job->out_date >= date('Y-m-d'))
                                                        <p>
                                                            <input type="checkbox" id="{{ $key }}" value="{{ $job->id }}" name="cb">
                                                            <label for="{{ $key }}">{{ $job->title }}
                                                                <span>({{ count($job->applications) }})</span>
                                                            </label>
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 jp_cl_right_bar">
                    <div class="row" id="box-candidate">
                        @foreach ($jobs as $key => $job)
                            @foreach ($job->applications as $key => $application)
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="jp_recent_resume_box_wrapper @if ($application->status == config('app.candidate_apply_checked'))  candidate_checked @endif">
                                        <div class="jp_recent_resume_img_wrapper">
                                            @if (file_exists(config('app.candidate_media_url') . $application->user->candidate->avatar_url))
                                                <img src="{{ asset(config('app.candidate_media_url') . $application->user->candidate->avatar_url) }}" class="candidate_list_img" alt="resume_img">
                                            @else
                                                <img src="{{ asset(config('app.candidate_media_url') . 'user.png') }}" class="candidate_list_img" alt="resume_img">
                                            @endif
                                        </div>
                                        <div class="jp_recent_resume_cont_wrapper">
                                            <h3>{{ $application->user->name }}</h3>
                                            <p><a href="#" class="set_padding">{{ __('Job Name:') }}</a>{{ $application->job->title }}</p>
                                            <p><a href="#"><i class="fa fa-calendar"></i>&nbsp;<span class="set_padding">{{ __('Apply Date:') }}</span>{{ date('d - m - Y', strtotime($application->created_at)) }}</a></p>
                                            <p><a href="#"><i class="fa fa-map-marker"></i><span class="set_padding">{{ __('Location:') }}</span>{{ $application->job->locationJobs->name }}</a></p>
                                            @if ($application->note)
                                            <p><a href="#"><i class="fa fa-th-large"></i><span class="set_padding">{{ __('Note:') }}</span>{{ $application->note }}</a></p>
                                            @endif
                                        </div>
                                        <div class="jp_recent_resume_btn_wrapper">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('application.getDetailCandidate', $application->user->token) . '?job=' . $application->job->id }}">
                                                        {{ __('View Profile') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    @include('clients.home.partials.pagination')
                </div>
            </div>
        </div>
    </div>/
@endsection
@section('js_client')
    <script>
        $(document).ready(function () {
            var array_name = [];
            var i = 0;
            $('input[name = "cb"]').change(function () {
                var cb = $(this).val();
                if ($(this).prop('checked') == true) {
                    array_name[i] = cb;
                    i++;
                } else {
                    array_name.forEach(function (currentValue, index, array_name) {
                        if (cb == currentValue) {
                            array_name.splice(index, 1);
                            i--;
                        }
                    });
                }
                if (array_name.length > 0) {
                    $.get(window.location.origin + '/client-applications/applications/get-candidate-by-job/' + array_name, function (data) {
                        console.log(data);
                        $('#box-candidate').html(data);
                    });
                } else {
                    $.get(window.location.origin + '/client-applications/applications/get-all-candidate-by-user/{{ Auth::User()->id }}', function (data) {
                        console.log(data);
                        $('#box-candidate').html(data);
                    });
                }
            });
        });
    </script>
@endsection
