<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="jp_adp_form_heading_wrapper">
        <h2>{{ __('Job Details') }}</h2>
    </div>
    <div class="jp_adp_form_wrapper">
        {{ Form::text('title', null, ['maxlength' => 100, 'placeholder' => __('Job Title')]) }}
        {!! $errors->first('title', '<span class="red">:message</span>') !!}
    </div>
    <div class="jp_adp_form_wrapper">
        {!! Form::select('location_id', $locations, isset($job->location_id) ? $job->parent_id : 0,['class' => 'form-control']) !!}
        {!! $errors->first('location_id', '<span class="red">:message</span>') !!}
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-md-6 col-xs-12">
            <div class="jp_adp_form_wrapper">
                {{ Form::number('salary_min', null, ['placeholder' => 'Salary Min']) }}
                {!! $errors->first('salary_min', '<span class="red">:message</span>') !!}
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-md-6 col-xs-12">
            <div class="jp_adp_form_wrapper">
                {{ Form::number('salary_max', null, ['placeholder' => 'Salary Max']) }}
                {!! $errors->first('salary_max', '<span class="red">:message</span>') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-md-6 col-xs-12">
            <div class="jp_adp_form_wrapper">
                {{ Form::text('experience', null, ['maxlength' => 100, 'placeholder' => __('Experience')]) }}
                {!! $errors->first('experience', '<span class="red">:message</span>') !!}
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-md-6 col-xs-12">
            <div class="jp_adp_form_wrapper">
                {{ Form::date('out_date', null) }}
                {!! $errors->first('out_date', '<span class="red">:message</span>') !!}
            </div>
        </div>
    </div>
    <div class="jp_adp_form_wrapper">
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 bottom_line_Wrapper">
    <div class="jp_adp_form_heading_wrapper">
        <p>{{ __('All fields are mandetory') }}</p>
    </div>
    <div class="jp_adp_form_wrapper">
        {!! Form::select('category_ids[]', $categories, ['-' => '-----------------'],
                [
                    'id' => 'category_selector',
                    'class' => 'form-control',
                    'placeholder' => __('Category'),
                    'multiple' => 'multiple',
                ])
        !!}
        {!! $errors->first('category_ids[]', '<span class="red">:message</span>') !!}
    </div>
    <div class="jp_adp_form_wrapper">
        {!! Form::select('job_type_id', $jobTypes, null,['class' => 'form-control']) !!}
        {!! $errors->first('job_type_id', '<span class="red">:message</span>') !!}
    </div>
    <div class="jp_adp_form_wrapper">
        <select name="job_skill_ids[]" id="job_skill_selector" class="form-control" multiple>
        </select>
        {!! $errors->first('job_skill_ids[]', '<span class="red">:message</span>') !!}
    </div>
    <div class="jp_adp_form_wrapper">
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_adp_textarea_main_wrapper">
        {{ Form::textarea('description', null, ['maxlength' => 1000, 'placeholder' => __('Job Descriptions')]) }}
        {!! $errors->first('description', '<span class="red">:message</span>') !!}
    </div>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_adp_choose_resume">
        <p></p>
        <div class="custom-input">
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_adp_choose_resume_bottom_btn_post">
        <ul>
            <li>
                {{ Form::button(__('Save'), ['type' => 'submit', 'name' => 'submit_save', 'class' => 'btn btn-success'] ) }}
            </li>
        </ul>
    </div>
</div>

