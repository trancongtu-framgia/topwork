@extends('admin.layouts.base');
@section('base.content')
    {{ Form::model($location, ['url' => route('locations.update', $location->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) }}
        @include('admin.locations.partials.form')
    {{ Form::close() }}
@stop
