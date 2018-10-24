@extends('clients.layouts.master')
@section('content')
    @include('flash::message')
    <div class="jp_cp_profile_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="jp_cp_left_side_wrapper">
                        <div class="jp_cp_left_pro_wallpaper">
                            @if ($user->candidate->avatar_url)
                                <img src="{{ asset(config('app.candidate_media_url') . $user->candidate->avatar_url) }}" alt="profile_img">
                            @else
                                <img src="{{ asset(config('app.candidate_media_url') . 'user.png') }}" alt="profile_img">
                            @endif
                            <h2>{{ $user->candidate->name }}</h2>
                            <p>{{ __('UI/UX Designer in Dewas') }}</p>
                            <ul>
                                @if ($user->candidate->facebook)
                                    <li><a href="{{ $user->candidate->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if ($user->candidate->twister)
                                    <li><a href="{{ $user->candidate->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                @endif
                                @if ($user->candidate->youtube)
                                    <li><a href="{{ $user->candidate->youtube }}"><i class="fa fa-youtube-play"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="jp_add_resume_wrapper jp_job_location_wrapper jp_cp_left_ad_res">
                        <div class="jp_add_resume_img_overlay"></div>
                        <div class="jp_add_resume_cont">
                            <ul>
                                <li><a href="#"><i class="fa fa-plus-circle"></i>ADD CV</a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ route('candidate.getEditInfo', 1) }}"><i class="fa fa-plus-circle"></i>EDIT PROFILE</a></li>
                            </ul>
                        </div>
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
                                    <td class="td-w65">{{ $user->candidate->name }}</td>
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
                                    <td class="td-w65">{{ $user->candidate->user->email }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="jp_cp_accor_heading_wrapper">
                                <h2>Experience</h2>
                                <p>{{ $user->candidate->experience }}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="accordion_wrapper abt_page_2_wrapper">
                                <div class="panel-group" id="accordion_threeLeft">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bell">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion_threeLeft" href="#collapseTwentyLeftThree" aria-expanded="false">Frofile Detail</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwentyLeftThree" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                                            <div class="panel-body">
                                                {!! $user->candidate->description !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading bell">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion_threeLeft" href="#collapseTwentyLeftThree3" aria-expanded="false">
                                                    CV File
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwentyLeftThree3" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                                            <div class="panel-body">
                                                @foreach($user->cvs as $key => $value)
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            {{ $value->url }}
                                                        </div>
                                                        <div class="col-md-4">
                                                            @include('elements.button_model', ['nameRoute' => 'job-types.destroy', 'data' => $value])
                                                        </div>
                                                    </div>
                                                @endforeach
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
