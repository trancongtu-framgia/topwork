@extends('clients.layouts.master')
@section('js_client')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'description', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        });
    </script>
@endsection
@section('content')
    {{ Form::model($user->candidate, ['url' => route('candidate.putEditInfo', $user->candidate->id), 'enctype' => 'multipart/form-data', 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) }}
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
                            <h2>{{ $user->name }}</h2>
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
                        <div style="text-align: center">
                            {{ Form::button(__('Save'), ['type' => 'submit', 'name' => 'submit_save', 'class' => 'btn btn-success allbutton'] ) }}
                            <a class="btn btn-primary" href="{{ route('candidate.getInfo', $user->token) }}">{{ __('Cancel') }}</a>
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
                                    <td class="td-w25">{{ __('Full name') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        {{ Form::text('name', $user->name, ['class' => 'form-control', 'maxlength' => 100]) }}
                                        {!! $errors->first('name', '<span class="red">:message</span>') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Date of birth') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        {{ Form::date('dob', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                        {!! $errors->first('dob', '<span class="red">:message</span>') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Address') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        {{ Form::text('address', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                        {!! $errors->first('address', '<span class="red">:message</span>') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Phone') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        {{ Form::text('phone', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                        {!! $errors->first('phone', '<span class="red">:message</span>') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('FaceBook') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        {{ Form::text('facebook', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                        {!! $errors->first('facebook', '<span class="red">:message</span>') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Youtube') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        {{ Form::text('youtube', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                        {!! $errors->first('youtube', '<span class="red">:message</span>') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('twitter') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        {{ Form::text('twitter', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                        {!! $errors->first('twitter', '<span class="red">:message</span>') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Experience') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        {{ Form::textarea('experience', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                        {!! $errors->first('experience', '<span class="red">:message</span>') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-w25">{{ __('Avatar') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        <div class="form-control">
                                            {{ Form::file('avatar', null) }}
                                            {!! $errors->first('avatar', '<span class="red">:message</span>') !!}
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="accordion_wrapper abt_page_2_wrapper">
                                <div class="panel-group" id="accordion_threeLeft">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bell">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion_threeLeft" href="#collapseTwentyLeftThree" aria-expanded="false">
                                                    {{ __('Profile Detail') }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwentyLeftThree" class="panel-collapse collapse" aria-expanded="false" role="tablist">
                                            <div class="panel-body">
                                                {{ Form::textarea('description', null, ['id' => 'description'], ['class' => 'form-control ckeditor', 'maxlength' => 100]) }}
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
    {{ Form::close() }}
@endsection
