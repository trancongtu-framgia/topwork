<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="jp_adp_form_heading_wrapper">
        <h2>{{ __('Job Details') }}</h2>
    </div>
    <div class="input-group jp_adp_form_wrapper">
        <span class="input-group-addon"> {{ __('Job Title') }} </span>
        {{ Form::text('title', null, ['maxlength' => 100, 'class' => 'form-control']) }}
    </div>
    {!! $errors->first('title', '<span class="red">:message</span>') !!}
    <div class="input-group jp_adp_form_wrapper">
        <span class="input-group-addon"> {{ __('Location') }} </span>
        {!! Form::select('location_id', $locations, isset($job->location_id) ? $job->parent_id : 0,['class' => 'form-control']) !!}
    </div>
    {!! $errors->first('location_id', '<span class="red">:message</span>') !!}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-md-6 col-xs-12">
            <div class="input-group jp_adp_form_wrapper">
                <span class="input-group-addon">{{ __('Salary From ($)') }}</span>
                {!!
                    Form::number('salary_min', null, [
                        'placeholder' => __('From'),
                        'class' => 'form-control',
                    ])
                !!}
            </div>
            {!! $errors->first('salary_min', '<span class="red">:message</span>') !!}

        </div>
        <div class="col-lg-6 col-md-6 col-md-6 col-xs-12">
            <div class="input-group jp_adp_form_wrapper">
                <span class="input-group-addon">{{ __('Up To $') }}</span>
                {!!
                    Form::number('salary_max', null, [
                        'placeholder' => __('Up to'),
                        'class' => 'form-control',
                    ])
                !!}
            </div>
            {!! $errors->first('salary_max', '<span class="red">:message</span>') !!}
        </div>
    </div>
    @if (session()->has('salary'))
        <span class="red invalid-feedback" role="alert">
            <strong>{{ session('salary') }}</strong>
        </span>
    @endif
    <div class="input-group jp_adp_form_wrapper">
        <span class="input-group-addon"> {{ __('Experience') }} </span>
        {{ Form::text('experience', null, ['maxlength' => 100, 'class' => 'form-control']) }}
    </div>
    {!! $errors->first('experience', '<span class="red">:message</span>') !!}
    <div class="input-group jp_adp_form_wrapper">
        <span class="input-group-addon"> {{ __('Out Date') }} </span>
        {{ Form::date('out_date', isset($job->out_date) ? $job->out_date : date('Y-m-d',strtotime(date('Y-m-d').' +30 days')), ['class' => 'form-control']) }}
    </div>
    {!! $errors->first('out_date', '<span class="red">:message</span>') !!}
    @if (session()->has('out_date'))
        <span class="red invalid-feedback" role="alert">
            <strong>{{ session('out_date') }}</strong>
        </span>
    @endif
    <div class="jp_adp_form_wrapper">
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 bottom_line_Wrapper">
    <div class="jp_adp_form_heading_wrapper">
        <p>{{ __('All fields are mandetory') }}</p>
    </div>
    <div class="input-group jp_adp_form_wrapper">
        <span class="input-group-addon"> {{ __('Categories') }} </span>
        {!! Form::select('category_ids[]', $categories, $jobCategory,
                [
                    'id' => 'category_selector',
                    'class' => 'form-control',
                    'multiple' => 'multiple',
                ])
        !!}
    </div>
    {!! $errors->first('category_ids', '<span class="red">:message</span>') !!}
    <div class="input-group jp_adp_form_wrapper">
        <span class="input-group-addon"> {{ __('Job Type') }} </span>
        {!! Form::select('job_type_id', $jobTypes, isset($job->location_id) ? $job->parent_id : 0,['class' => 'form-control']) !!}
    </div>
    {!! $errors->first('job_type_id', '<span class="red">:message</span>') !!}
    <div class="input-group jp_adp_form_wrapper">
        <span class="input-group-addon"> {{ __('Skills') }} </span>
        <select name="job_skill_ids[]" id="job_skill_selector" class="form-control" multiple>
            @if ($skills)
                @foreach($skills as $skill)
                    {!! '<option value="' . $skill['id'] . '" '. ($skillJobs && in_array($skill['id'], $skillJobs) ? 'selected' : '') . '>' . $skill['name'] . '</option>' !!}
                @endforeach
            @endif
        </select>
    </div>
    {!! $errors->first('job_skill_ids', '<span class="red">:message</span>') !!}

    <div class="input-group jp_adp_form_wrapper">
        <span class="input-group-addon">{{ __('Candidate Number') }}</span>
        {!! Form::number('candidate_number', null, ['placeholder' => __('Candidate Number'), 'class' => 'form-control']) !!}
    </div>
    {!! $errors->first('candidate_number', '<span class="red">:message</span>') !!}

    <div class="input-group jp_adp_form_wrapper">
        <label>{{ __('Open Job') }}</label><br>
        <label class="switch">
            {{ Form::hidden('is_available', false) }}
            {{ Form::checkbox('is_available', true) }}
            <span class="slider round"></span>
        </label>
    </div>
    {!! $errors->first('is_available', '<span class="red">:message</span>') !!}
    <div class="jp_adp_form_wrapper">
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_adp_textarea_main_wrapper">
        {{ Form::textarea('description', null, ['placeholder' => __('Job Descriptions'), 'class' => 'ckeditor']) }}
    </div>
    {!! $errors->first('description', '<span class="red">:message</span>') !!}
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_adp_choose_resume">
        <p></p>
        <div class="custom-input">
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    {{ Form::button('<i class="fa fa-chevron-left"></i> &nbsp;' .__('cancel'), ['type' => 'button', 'class' => 'btn', 'id' => 'buttonBack'] ) }}

    {{ Form::button('<i class="fa fa-save"></i> &nbsp;' . __('Save'), ['type' => 'submit', 'name' => 'submit_save', 'class' => 'btn btn-success'] ) }}
</div>
