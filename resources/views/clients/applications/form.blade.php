<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_adp_form_wrapper">
        <div class="jp_adp_form_wrapper">
            {{ Form::label(__('Your Name')) }}
            {{ Form::text('candidate_name', $user->name, ['maxlength' => 100, 'readonly' => 'true']) }}
            {{ Form::hidden('job_title', $job['job']->title) }}
            {!! $errors->first('title', '<span class="red">:message</span>') !!}
        </div>
        <div class="jp_adp_form_wrapper">
            {{ Form::label(__('Your email')) }}
            {{ Form::text('', $user->email, ['maxlength' => 100, 'readonly' => 'true']) }}
            {!! $errors->first('title', '<span class="red">:message</span>') !!}
        </div>
    </div>
    <div class="jp_adp_form_wrapper">
    </div>
    {{ Form::label(__('Your cv')) }}
    {{ Form::file('cv_url', ['required' => 'true', 'class' => 'form-control']) }}
    {!! $errors->first('cv_url', '<span class="red">:message</span>') !!}
    <div class="jp_adp_form_wrapper">
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_adp_textarea_main_wrapper">
        {{ Form::label(__('Self Introduction')) }}
        {{ Form::textarea('self_introduction', null, [
            'maxlength' => 300,
            'required' => 'true',
            'placeholder' => __('What skills, work projects or achievements make you a strong candidate? (Recommended)'),
        ]) }}
        {!! $errors->first('self_introduction', '<span class="red">:message</span>') !!}
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_adp_choose_resume_bottom_btn_post">
        <ul>
            <li>
                @if ($canApply)
                    {{ Form::button(__('Apply'), [
                        'type' => 'submit',
                        'name' => 'submit_save',
                        'class' => 'btn btn-success',
                    ]) }}
                @else
                    {{ Form::button(__('Apply'), [
                        'type' => 'submit',
                        'name' => 'submit_save',
                        'class' => 'btn btn-success',
                        'disabled',
                    ]) }}
                @endif
            </li>
        </ul>
    </div>
</div>

