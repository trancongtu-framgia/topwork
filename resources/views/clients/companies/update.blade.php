@extends('clients.layouts.master')
@section('content')
    <div class="jp_cp_profile_main_wrapper content_client">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{ Form::model($company, ['url' => route('companies.update'), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) }}
                        <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                            <div class="form-group">
                                {!! Html::decode(Form::label('country', __('country') . '<span class="red">*</span>',
                                ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])) !!}
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                    {!! $errors->first('country', '<span class="red">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
