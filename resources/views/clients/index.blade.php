@extends('clients.layouts.master')
@section('content')
    @include('clients.layouts.header')
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                @if (Auth::check() && strtolower(Auth::user()->userRole->name) == config('app.candidate_role') && Auth::user()->is_first_login == config('app.is_first_login'))
                    @include('clients.candidates.partials.pop_up_add_book_marks')
                @endif
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>{{__('Jobs by Category')}}</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                @foreach ($categories as $key => $value)
                                                <p>
                                                    {!! Form::checkbox('category', $key, null,
                                                        [
                                                            'id' => 'category' . $key,
                                                            'class' => 'categoryCheckbox',
                                                        ]);
                                                    !!}
                                                    <label for="category{{ $key }}">{{ $value }}</label>
                                                </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>{{__('Jobs by Salary')}}</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                @foreach (config('app.ListSalary') as $key => $value)
                                                    <p>
                                                        {!! Form::checkbox('salary', $key, null,
															[
																'id' => 'salary' . $key,
																'class' => 'salaryCheckbox',
																'onChange' => 'getJobBySalary(this)'
															]);
														!!}
                                                        <label for="salary{{ $key }}">{{ $value }}</label>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div id="conten-job">
                        @include('clients.home.partials.contentShowJobs')
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 visible-sm visible-xs">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>{{_('Jobs by Category')}}</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                @foreach ($categories as $key => $value)
                                                    <p>
                                                        {!! Form::checkbox('category', $key); !!}
                                                        <label>{{ $value }}<span>(214)</span></label>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
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
        $(document).ready(function() {
            if ($('#pop-up-box').length) {
                showPopUp();
            }
        });
    </script>
@endsection
