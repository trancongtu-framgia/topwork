@extends('clients.layouts.master')
@section('content')
    @include('clients.layouts.header')
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
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
                                                            'onClick' => 'getJobByCategory(this)',
                                                        ]);
                                                    !!}
                                                    <label for="category{{ $key }}">{{ $value }}<span>(214)</span></label>
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
                    <div class="row" id="conten-job">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @include('clients.layouts.listWrapper')
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-content">
                                <div id="grid" class="tab-pane fade in active">
                                    <div class="row">
                                        @foreach($jobs as $job)
                                            @include('clients.home.partials.job_element_square')
                                        @endforeach
                                        @include('clients.home.partials.pagination')
                                    </div>
                                </div>
                                <div id="list" class="tab-pane fade">
                                    <div class="row">
                                        @foreach($jobs as $job)
                                            @include('clients.home.partials.job_element_retangle')
                                        @endforeach
                                        @include('clients.home.partials.pagination')
                                    </div>
                                </div>
                            </div>
                        </div>
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


