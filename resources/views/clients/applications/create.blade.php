@extends('clients.layouts.master')
@section('content')
@section('breadcrumb_title')
    {{ __('Apply Job') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Job') }}</a><i class="fa fa-angle-right"></i></li>
        <li>{{ __('Apply Job') }}</li>
    </ul>
@endsection
@include('clients.layouts.breadcrumb')
<div class="jp_adp_main_section_wrapper">
    <div class="container">
        <div class="row">
            @include('clients.applications.job_element')
            {{ Form::open([
                'url' => route('applyjobs.store'),
                'method' => 'POST',
                'class' => 'form-horizontal form-label-left',
                'files' => 'true',
            ]) }}
                {{ Form::hidden('job_id', $job['job']->id) }}
                @include('clients.applications.form')
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection
