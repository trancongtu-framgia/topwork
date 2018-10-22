@extends('admin.layouts.base');
@section('base.content')
    {{ Form::open(['url' => route('job-type.store'), 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) }}
        @include('admin.job_types.partials.form')
    {{ Form::close() }}
@stop
