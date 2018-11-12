@extends('clients.layouts.master')
@section('js_client')
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'description', {
            filebrowserBrowseUrl: '{{ asset('plugins/ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('plugins/ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('plugins/ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#submitForm').click(function () {
                $('#editCandidate').submit();
            });
        })
    </script>
    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--var array_name = [];--}}
            {{--$('input[name = "cb"]').change(function () {--}}
                {{--$('input[name = "cb"]:checked').each(function(i){--}}
                    {{--array_name[i] = $(this).val();--}}
                {{--});--}}
            {{--})--}}

            {{--$('#edit-book-mark').click(function () {--}}
                {{--$('#pop-up-box').fadeIn(300);--}}
                {{--$('body').append('<div id="over">');--}}
                {{--$('#over').fadeIn(500);--}}
            {{--})--}}

            {{--$('#postBookMark').click(function () {--}}
                {{--setupAjax();--}}
                {{--$.ajax({--}}
                    {{--url: route('post.bookMark'),--}}
                    {{--type: 'POST',--}}
                    {{--data: {categoryId:array_name},--}}
                    {{--success: function (data) {--}}
                        {{--if (data) {--}}
                            {{--alert('ngu');--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
            {{--})--}}
        {{--});--}}
    {{--</script>--}}
@endsection
@section('content')
@section('breadcrumb_title')
    {{ __('Candidate Profile') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li class="set_padding">{{ __('Candidate Profile') }}<i class="fa fa-angle-right"></i></li>
        <li class="set_padding">{{ __('Edit Candidate Profile') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
    <div class="row">
        @if(Auth::check() && strtolower(Auth::user()->userRole->name) == config('app.candidate_role') && Auth::user()->is_first_login == config('app.is_first_logged'))
            @include('clients.candidates.partials.pop_up_add_book_marks')
        @endif
    </div>
    {{ Form::model($user->candidate, ['url' => route('candidate.putEditInfo', $user->token), 'enctype' => 'multipart/form-data', 'method' => 'PUT', 'class' => 'form-horizontal form-label-left', 'id' => 'editCandidate']) }}
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
                            <ul class="set_padding">
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
                        <div class="jp_add_resume_cont jp_add_resume_wrapper">
                            <ul>
                                <li><a id="submitForm"><i class="fa fa-pencil-square-o set_padding"></i>{{ __('Save') }}</a></li>
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
                                    <td class="td-w25">{{ __('Twitter') }}</td>
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
                                <tr>
                                    <td class="td-w25">{{ __('Book Mark') }}</td>
                                    <td class="td-w10">:</td>
                                    <td class="td-w65">
                                        <a href="#"  id="edit-book-mark">
                                            <input class="btn btn-danger" type="button" value="{{ __('Edit Book Mark') }}">
                                        </a>
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
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion_threeLeft" href="#collapseTwentyLeftThree" aria-expanded="true">
                                                    {{ __('Profile Detail') }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwentyLeftThree" class="panel-collapse collapse show" aria-expanded="false" role="tablist">
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
