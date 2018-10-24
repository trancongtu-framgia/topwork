@extends('admin.layouts.base');
@section('base.title')
    {{ __('Add New') }}
@endsection()
@section('base.content')
    <!--begin: Datatable -->
    {{ Form::open(['url' => route('skills.store'), 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) }}
    @include('admin.skills.partials.form')
    {{ Form::close() }}
    <!--end: Datatable -->
@stop
