@extends('clients.layouts.master')
@section('content')
    @foreach($jobs as $job)
        @include('clients.jobs.partials.job_element')
    @endforeach
@endsection
