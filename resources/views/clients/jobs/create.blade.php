@extends('clients.layouts.master')
@section('css_client')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" />
@endsection
@section('js_client')
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/job.js') }}"></script>
@endsection
@section('content')
@section('breadcrumb_title')
    {{ __('Job Detail') }}
@endsection
@section('breadcrumb_step')
    <ul>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Job Detail') }}</li>
    </ul>
@endsection
<div class="jp_adp_main_section_wrapper">
    <div class="container">
        <div class="row">
            {{ Form::open(['url' => route('jobs.store'), 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) }}
            @include('clients.jobs.partials.form')
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection
