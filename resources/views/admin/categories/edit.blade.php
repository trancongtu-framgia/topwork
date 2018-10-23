@extends('admin.layouts.base');
@section('base.title')
    {{ __('Edit Category') }}
@endsection()
@section('base.content')
    <!--begin: Datatable -->
    {{ Form::model($category, ['url' => route('categories.update', ['id' => $category->id]), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) }}
    @include('admin.categories.partials.form')
    {{ Form::close() }}
    <!--end: Datatable -->
@stop
