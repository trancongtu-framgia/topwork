<div class="jp_regiter_top_heading">
    <p>{{ __('Fields with * are mandetory') }} </p>
</div>
<div class="row">
    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('name', null, ['placeholder' => __('Full name*')]) !!}
            {!! $errors->first('name', '<span class="red">:message</span>') !!}
        </div>

        <!--Form Group-->
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('user_name', null, ['placeholder' => __('User name*')]) !!}
            {!! $errors->first('user_name', '<span class="red">:message</span>') !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            {!! Form::email('email', null, ['placeholder' => __('Email*')]) !!}
            {!! $errors->first('email', '<span class="red">:message</span>') !!}
        </div>
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('address', null, ['placeholder' => __('Address*')]) !!}
            {!! $errors->first('address', '<span class="red">:message</span>') !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            {!! Form::password('password', ['placeholder' => __('Password*')]) !!}
            {!! $errors->first('password', '<span class="red">:message</span>') !!}
        </div>
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            {!! Form::password('password_confirm', ['placeholder' => __('Re-enter password*')]) !!}
            {!! $errors->first('password_confirm', '<span class="red">:message</span>') !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('phone', null, ['placeholder' => __('Phone*')]) !!}
            {!! $errors->first('phone', '<span class="red">:message</span>') !!}
        </div>
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('description', null, ['placeholder' => __('Description*')]) !!}
            {!! $errors->first('phone', '<span class="red">:message</span>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 col-sm-6 col-xs-12">
        {!! Form::hidden('role_name', config('app.company_role')) !!}
    </div>
</div>
<div class="login_btn_wrapper register_btn_wrapper login_wrapper ">
    <a href="#" id="submitCompany" class="btn btn-primary login_btn"> {{ __('register') }} </a>
</div>
<div class="login_message">
    <p>{{ __('Already a member?') }} <a href="#"> {{ __('Login Here') }} </a></p>
</div>
