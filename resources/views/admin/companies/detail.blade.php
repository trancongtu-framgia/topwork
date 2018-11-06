@extends('admin.layouts.base')
@section('base.title')
    {{ __('Company Detail') }}
@endsection
@section('base.function')
@endsection
@section('base.content')
    <div class="jumbotron">
        <div class="center-text">
            <img class="h-25 w-25 img-responsive" src="{{ asset(config('app.client_media_url') . $company['logo']) }}" alt="post_img">
        </div>
        <div class="col-sm-12 mx-auto">
            <h1>{{ $company['name'] }}</h1>
            <p>{{ __('Range') . ': ' . $company['range'] }}</p>
            <p>{{ __('Working Day') . ': ' . $company['working_day'] }}</p>
            <p>{{ __('Country') . ': ' . $company['country'] }}</p>
            <p>{{ __('Address') . ': ' . $company['address'] }}</p>
            <p>{{ __('Description') }}</p>
            <div class="pre-scrollable">
                <p>{!! $company['description'] !!}</p>
            </div>
        </div>
    </div>
    <p>
        @if ($company['active'] == config('app.status_account_pending'))
            <a class="btn btn-primary" href="{{ route('admin.companies.change', $company['user_id']) }}" role="button">{{ __('Activate') }}</a>
        @elseif ($company['active'] == config('app.status_account_activate'))
            <a class="btn btn-danger" href="{{ route('admin.companies.change', $company['user_id']) }}" role="button">{{ __('Deactivate') }}</a>
        @elseif ($company['active'] == config('app.status_account_deactivate'))
            <a class="btn btn-primary disabled" onclick="return false;" href="" role="button">{{ __('Activate') }}</a>
        @endif
    </p>
@stop
