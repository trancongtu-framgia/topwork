@extends('admin.layouts.base');
@section('base.content')
    {{ Form::model($role, ['url' => route('roles.update', $role->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) }}
        @include('admin.roles.partials.form')
    {{ Form::close() }}
@stop
