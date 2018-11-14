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
    <div class="jp_cp_profile_main_wrapper">
        <div class="container">
            @include('flash::message')
            <div class="row">
                @if(Auth::check() && strtolower(Auth::user()->userRole->name) == config('app.candidate_role') && Auth::user()->is_first_login == config('app.is_first_logged'))
                    @include('clients.candidates.partials.pop_up_add_book_marks')
                @endif
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="jp_cp_left_side_wrapper">
                        <div class="jp_cp_left_pro_wallpaper">
                            <img class="image_candidate" src="{{ asset(config('app.candidate_media_url') . $user->candidate->avatar_url) }}" alt="profile_img">
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
                        @if ($checkAuth)
                        <ul>
                            <li>
                                <a href="{{ route('candidate.getEditInfo', $user->token) }}">
                                    <i class="fa fa-pencil-square-o set_padding" aria-hidden="true"></i>{{ __('EDIT PROFILE') }}
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="#" id="edit-book-mark">
                                    <i class="fa fa-pencil-square-o set_padding" aria-hidden="true"></i>{{ __('EDIT BOOK MARK') }}
                                </a>
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="jp_cp_right_side_wrapper">
                        <div class="jp_cp_right_side_inner_wrapper">
                            {{ Form::hidden('candidate_token', $user->token, ['id' => 'candidate_token']) }}
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
                                @if ($checkAuth || $isPublicCandidate)
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
                                @endif
                                </tbody>
                            </table>
                            @if ($checkAuth)
                            <label>{{ __('Public') }}</label><br>
                            <label class="switch">
                                {{ Form::checkbox('is_public', true,
                                    $user->candidate->is_public == 0 ? false : true,
                                    ['onChange' => 'is_public_candidate(\'' . config('app.locale') . '\', \''.__('Update'). '\')'])
                                }}
                                <span class="slider round"></span>
                            </label>
                            @endif
                        </div>
                    </div>
                    @if ($checkAuth || $isPublicCandidate)
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="jp_cp_accor_heading_wrapper">
                                    <h2>{{ __('Profile Detail') }}</h2>
                                    <div class="content-cadidate-description">
                                        {!! $user->candidate->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
