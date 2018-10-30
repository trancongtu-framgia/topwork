@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('All Applied Jobs') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;{{ __('All Applied Jobs') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_listing_heading_wrapper">
                        <h2>{{ __('All Applied Jobs') }}</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_listing_tabs_wrapper">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="gc_causes_view_tabs_wrapper">
                                        <div class="gc_causes_view_tabs">
                                            <ul class="nav nav-pills">
                                                <li class="active">
                                                    <a data-toggle="pill" href="#grid"><i class="fa fa-th-large"></i></a>
                                                </li>
                                                <li>
                                                    <a data-toggle="pill" href="#list"><i class="fa fa-list"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="gc_causes_search_box_wrapper gc_causes_search_box_wrapper2">
                                        <div class="gc_causes_search_box">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-content">
                                <div id="grid" class="tab-pane fade in active">
                                    <div class="row">
                                        @foreach ($jobs as $job)
                                            @include('clients.applications.candidates.job_element_square')
                                        @endforeach
                                        @include('clients.home.partials.pagination')
                                    </div>
                                </div>
                                <div id="list" class="tab-pane fade">
                                    <div class="row">
                                        @foreach ($jobs as $job)
                                            @include('clients.applications.candidates.job_element_retangle')
                                        @endforeach
                                        @include('clients.home.partials.pagination')
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
