@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('All Jobs') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;{{ __('All Jobs') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            @include('clients.home.partials.contentShowJobs')
        </div>
    </div>

@endsection
