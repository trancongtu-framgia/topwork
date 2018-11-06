@extends('admin.layouts.base')
@section('base.title')
    {{ __('Company List') }}
@endsection
@section('base.function')
@endsection
@section('base.content')
    <table class="table">
        <thead>
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Company Name') }}</th>
            <th>{{ __('Status') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td><a href="{{ route('admin.companies.detail', $company->id) }}">{{ $company->name }}</a></td>
                <td>{{ $company->email }}</td>
                @if ($company->status == config('app.job_close_status'))
                    <td><label class="badge badge-danger">{{ __('In Active') }}</td></label>
                @elseif ($company->status == config('app.job_open_status'))
                    <td><label class="badge badge-success">{{ __('Active') }}</td></label>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
