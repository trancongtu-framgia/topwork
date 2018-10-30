@extends('clients.layouts.master')
@section('content')
    @include('clients.layouts.header')
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_listing_heading_wrapper">
                        <h2> {!! __('We found :total jobs for you', ['total' => $jobs->total()]) !!} </h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
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
            </div>
        </div>
    </div>
@endsection