@extends('admin.layouts.base');
@section('base.title')
    {{ __('Add New') }}
@endsection()
@section('base.content')
    <!--begin: Datatable -->
    {{ Form::open(['url' => route('categories.store'), 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) }}
    @include('admin.categories.partials.form')
    {{ Form::close() }}
    <!--end: Datatable -->
@stop
