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
                    <div id="conten-job">
                        @include('clients.home.partials.contentShowJobs')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
