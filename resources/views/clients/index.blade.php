@extends('clients.layouts.master')
@section('content')
    @include('clients.layouts.header')
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                @if(Auth::check() && strtolower(Auth::user()->userRole->name) == config('app.candidate_role') && Auth::user()->is_first_login == config('app.is_first_login'))
                    <div class="pop-up" id="pop-up-box">
                        {{ Form::open(['url' => '', 'method' => 'POST', 'class' => 'pop-up-content', 'id' => 'postForm']) }}
                            <div>
                                <h2 class="title-pop-up">{{ __('What category are you interesting?') }}</h2>
                            </div>
                            <div class="pricing_cont_wrapper">
                                <div class="pricing_cont handyman_sec1_wrapper" >
                                    <div class="book-mark-list-category">
                                        <ul>
                                            @foreach ($categories as $key => $category)
                                                <li>
                                                    <p>
                                                        {!! Form::checkbox('cb', $key, null, ['id' => $key]) !!}
                                                        {!! Form::label($key, $category) !!}
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pricing_btn_wrapper">
                                <div class="pricing_btn2">
                                    <ul>
                                        <li><a id="postBookMark"><i class=" btn-primary login_btn"></i>{{ __('Save') }}</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <a class="exit" >Bỏ qua</a>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
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
