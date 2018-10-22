@extends('admin.layouts.base');
@section('base.content')
    {{ Form::model($jobType, ['url' => route('job-type.update', $jobType->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) }}
        @include('admin.job_types.partials.form')
    {{ Form::close() }}
@stop
