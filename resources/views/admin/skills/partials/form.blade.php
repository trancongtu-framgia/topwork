<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <div class="form-group">
        {!! Html::decode(Form::label('name', __('Skill Name') . '<span class="red">*</span>',
        ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])) !!}
        <div class="col-md-12 col-sm-6 col-xs-12">
            {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) }}
            {!! $errors->first('name', '<span class="red">:message</span>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('') ? 'has-error' : '' }}">
    <div class="form-group">
        {!! Html::decode(Form::label('category_id', __('Category') . '<span class="red">*</span>',
        ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])) !!}
        <div class="col-md-12 col-sm-6 col-xs-12">
            {!! Form::select('category_id', $categories,
            isset($skill->category_id) ? $skill->category_id : 0, ['class' => 'form-control']) !!}
            {!! $errors->first('parent_id', '<span class="red">:message</span>') !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-6 col-xs-12 col-md-offset-3">
        {{ Form::button(__('Save'), ['type' => 'submit', 'name' => 'submit_save', 'class' => 'btn btn-success'] ) }}
        <a class="btn btn-primary pull-right" href="{{ route('skills.index') }}">{{ __('Cancel') }}</a>
    </div>
</div>
