@extends('clients.layouts.master')
@section('content')
    <div class="login_section">
        <!-- login_form_wrapper -->
        <div class="login_form_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!-- login_wrapper -->
                        <h1>LOGIN TO YOUR ACCOUNT</h1>
                        <div class="login_wrapper">
                            <div class="formsix-pos">
                                <div class="form-group i-email">
                                    <input type="email" class="form-control" required="" id="email2" placeholder="Username*">
                                </div>
                            </div>
                            <div class="formsix-e">
                                <div class="form-group i-password">
                                    <input type="password" class="form-control" required="" id="password2" placeholder="Password *">
                                </div>
                            </div>
                            <div class="login_remember_box">
                                <label class="control control--checkbox">Remember me
                                    <input type="checkbox">
                                    <span class="control__indicator"></span>
                                </label>
                                <a href="#" class="forget_password">
                                    {{__('Forgot Password')}}
                                </a>
                            </div>
                            <div class="login_btn_wrapper">
                                <a href="#" class="btn btn-primary login_btn"> {{__('Login')}} </a>
                            </div>
                            <div class="login_message">
                                <p>{{__('Don’t have an account ?')}} <a href="#"> {{__('Register Now')}} </a> </p>
                            </div>
                        </div>
                        <p>{{__('In case you are using a public/shared computer we recommend that
                            you logout to prevent any un-authorized access to your account')}}</p>
                        <!-- /.login_wrapper-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.login_form_wrapper-->
    </div>
@endsection


