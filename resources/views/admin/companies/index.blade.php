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
                <td><a href="{{ route('admin.companies.status', $company->status) }}">
                    @if ($company->status == config('app.status_account_deactivate'))
                        <label class="badge badge-danger">{{ __('In Active') }}</label>
                    @elseif ($company->status == config('app.status_account_pending'))
                        <label class="badge badge-warning">{{ __('Verified | Pending') }}</label>
                    @elseif ($company->status == config('app.status_account_activate'))
                        <label class="badge badge-success">{{ __('Activated') }}</label>
                    @endif
                </a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
