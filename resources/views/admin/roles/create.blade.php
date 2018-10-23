@extends('admin.layouts.base');
@section('base.content')
    {{ Form::open(['url' => route('roles.store'), 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) }}
        @include('admin.roles.partials.form')
    {{ Form::close() }}
@stop
