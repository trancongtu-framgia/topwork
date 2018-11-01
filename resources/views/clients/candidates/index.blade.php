@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('Candidate Profile') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li class="set_padding">{{ __('Candidate Profile') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
    @include('flash::message')
    <div class="jp_cp_profile_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="jp_cp_left_side_wrapper">
                        <div class="jp_cp_left_pro_wallpaper">
                            @if (file_exists(config('app.candidate_media_url') . $user->candidate->avatar_url))
                                <img class="image_candidate" src="{{ asset(config('app.candidate_media_url') . $user->candidate->avatar_url) }}" alt="profile_img">
                            @else
                                <img class="image_candidate" src="{{ asset(config('app.candidate_media_url') . 'user.png') }}" alt="profile_img">
                            @endif
                            <h2 class="set_padding">{{ $user->name }}</h2>
                            <ul>
                                @if ($user->candidate->facebook)
                                    <li><a href="{{ $user->candidate->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if ($user->candidate->twitter)
                                    <li><a href="{{ $user->candidate->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                @endif
                                @if ($user->candidate->youtube)
                                    <li><a href="{{ $user->candidate->youtube }}"><i class="fa fa-youtube-play"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="jp_add_resume_cont jp_add_resume_wrapper">
                        @if (Auth::check() && Auth::user()->token == $user->token)
                        <ul>
                            <li><a href="{{ route('candidate.getEditInfo', $user->token) }}"><i class="fa fa-pencil-square-o set_padding" aria-hidden="true"></i>{{ __('EDIT PROFILE') }}</a></li>
                        </ul>
                        @endif
                        <ul>
                            <li><a href="{{ route('home.index') }}"><i class="fa fa-backward set_padding" aria-hidden="true"></i>{{ __('BACK') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="jp_cp_right_side_wrapper">
                        <div class="jp_cp_right_side_inner_wrapper">
                            <h2>{{ __('PERSONAL DETAILS') }}</h2>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="jp_cp_accor_heading_wrapper">
                                <h2>{{ __('Experience') }}</h2>
                                <p>{{ $user->candidate->experience }}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="accordion_wrapper abt_page_2_wrapper">
                                <div class="panel-group" id="accordion_threeLeft">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bell">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion_threeLeft" href="#collapseTwentyLeftThree" aria-expanded="false">{{ __('Profile Detail') }}</a>
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
        </div>
    </div>
@endsection
