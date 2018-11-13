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
                $('#editCompany').submit();
            });
        })
    </script>
@endsection
@section('content')

                    {{ Form::model($company, ['url' => route('companies.update', $company->id), 'enctype' => 'multipart/form-data', 'method' => 'PUT', 'class' => 'form-horizontal form-label-left', 'id' => 'editCompany']) }}
                    <div class="jp_cp_profile_main_wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="jp_cp_left_side_wrapper">
                                        <div class="jp_cp_left_pro_wallpaper">
                                            @if (file_exists(config('app.company_media_url') . $company->logo_url))
                                                <img class="image_candidate" src="{{ asset(config('app.company_media_url') . $company->logo_url) }}" alt="profile_img">
                                            @else
                                                <img class="image_candidate" src="{{ asset(config('app.company_media_url') . 'user.png') }}" alt="profile_img">
                                            @endif
                                            <h2 class="set_padding">{{ $company->companyUser->name }}</h2>
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
                                            <h2>{{ __('COMPANY DETAILS') }}</h2>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="td-w25">{{ __('Full name') }}</td>
                                                    <td class="td-w10">:</td>
                                                    <td class="td-w65">
                                                        {{ Form::text('name', $company->companyUser->name, ['class' => 'form-control', 'maxlength' => 100]) }}
                                                        {!! $errors->first('name', '<span class="red">:message</span>') !!}
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
                                                    <td class="td-w25">{{ __('Range of Company') }}</td>
                                                    <td class="td-w10">:</td>
                                                    <td class="td-w65">
                                                        {{ Form::text('range', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                                        {!! $errors->first('address', '<span class="red">:message</span>') !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-w25">{{ __('Country') }}</td>
                                                    <td class="td-w10">:</td>
                                                    <td class="td-w65">
                                                        {{ Form::text('country', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                                        {!! $errors->first('address', '<span class="red">:message</span>') !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-w25">{{ __('Day of Work') }}</td>
                                                    <td class="td-w10">:</td>
                                                    <td class="td-w65">
                                                        {{ Form::text('working_day', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                                        {!! $errors->first('address', '<span class="red">:message</span>') !!}
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
