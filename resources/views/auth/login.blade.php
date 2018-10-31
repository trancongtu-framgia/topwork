@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('login') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('login') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
    <div class="login_section">
        <!-- login_form_wrapper -->
        <div class="login_form_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!-- login_wrapper -->
                        <h1>{{ __('LOGIN TO YOUR ACCOUNT') }}</h1>
                        <div class="login_wrapper">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; {{ $error }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {!! Form::open(['route' => 'login']) !!}
                            <div class="formsix-pos">
                                <div class="form-group i-email">
                                    {!! Form::text('email',null,
										  [
											  'class' => 'form-control',
											  'placeholder' => 'Email',
										  ]
									)
									!!}
                                </div>
                            </div>
                            <div class="formsix-e">
                                <div class="form-group i-password">
                                    {!! Form::password('password',
										  [
											  'class' => 'form-control',
											  'placeholder' => 'Password',
										  ]
									)
									!!}
                                </div>
                            </div>
                            <div class="login_remember_box">
                                <label class="control control--checkbox">{{ __('Remember me') }}
                                    {!! Form::checkbox('remember', old('remember') ? 'true' : '') !!}
                                    <span class="control__indicator"></span>
                                </label>
                                <a href="#" class="forget_password">
                                    {{ __('Forgot Password') }}
                                </a>
                            </div>
                            <div class="login_btn_wrapper">
                                {!! Form::submit( __('login'),
									  [
										 'class' => 'btn btn-primary login_btn',
										 'id' => 'login_btn',
									  ]
								)
								!!}
                            </div>
                            {!! Form::close() !!}
                            <div class="login_message">
                                <p>{{ __('Don’t have an account') }} <a
                                        href="{{ url('/register') }}"> {{ __('Register Now') }} </a></p>
                            </div>
                        </div>
                        <p>{!! __('comment login') !!}</p>
                        <!-- /.login_wrapper-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.login_form_wrapper-->
    </div>
@endsection
