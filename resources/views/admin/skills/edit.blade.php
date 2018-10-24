@extends('admin.layouts.base');
@section('base.title')
    {{ __('Edit Skill') }}
@endsection()
@section('base.content')
    <!--begin: Datatable -->
    {{ Form::model($skill, ['url' => route('skills.update', ['id' => $skill->id]),
     'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) }}
    @include('admin.skills.partials.form')
    {{ Form::close() }}
    <!--end: Datatable -->
@stop
