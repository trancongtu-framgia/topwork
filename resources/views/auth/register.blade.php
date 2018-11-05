@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('Register') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li class="set_padding">{{ __('Register') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
<div class="register_section">
    <!-- register_form_wrapper -->
    <div class="register_tab_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul id="tabOne" class="nav register-tabs">
                            <li class="active">
                                <a href="#contentOne-1" data-toggle="tab">{{ __('personal account') }} <br>
                                    <span>{{ __('i am looking for a job') }}</span></a>
                            </li>
                            <li>
                                <a href="#contentOne-2" data-toggle="tab">{{ __('company account') }} <br>
                                    <span>{{ __('We are hiring Employees') }}</span></a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active register_left_form" id="contentOne-1">
                                {!! Form::open(['url' => route('register'), 'method' => 'POST', 'id' => 'registerCandidate']) !!}
                                @include('auth.register_candidate_form')
                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane fade register_left_form" id="contentOne-2">
                                {!! Form::open(['url' => route('register'), 'method' => 'POST', 'id' => 'registerCompany']) !!}
                                @include('auth.register_company_form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_client')
    <script>
        $(document).ready(function () {
            $('#submitCandidate').click(function () {
                $('#registerCandidate').submit();
            });
            $('#submitCompany').click(function () {
                $('#registerCompany').submit();
            })
        })
    </script>
@endsection
