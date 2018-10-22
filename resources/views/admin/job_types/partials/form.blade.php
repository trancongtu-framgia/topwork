<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <div class="form-group">
        {!! Html::decode(Form::label('name', 'Tên Kiểu Công Việc <span class="red">*</span>', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) }}
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('') ? 'has-error' : '' }}">
    <div class="form-group">
        {!! Html::decode(Form::label('description', 'Ghi chú <span class="red">*</span>', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{ Form::text('description', null, ['class' => 'form-control', 'maxlength' => 100]) }}
            {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>
<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <a class="btn btn-primary" href="{{ route('job-type.index') }}">{{ __('Cancel') }}</a>
        {{ Form::button(__('Save'), ['type' => 'submit', 'name' => 'submit_save', 'class' => 'btn btn-success'] ) }}
    </div>
</div>
