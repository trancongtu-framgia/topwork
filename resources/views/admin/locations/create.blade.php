@extends('admin.layouts.base');
@section('base.content')
    {{ Form::open(['url' => route('locations.store'), 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) }}
        @include('admin.locations.partials.form')
    {{ Form::close() }}
@stop
