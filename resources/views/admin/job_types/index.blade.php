@extends('admin.layouts.base');
@section('base.title')
    {{ __('List Job Type') }}
@endsection
@section('base.function')
    <a class="btn btn-success" href="{{ route('job-types.create') }}">{{ __('Add New +') }}</a>
@endsection
@section('base.content')
    <div class="m_datatable m-datatable m-datatable--default m-datatable--error m-datatable--loaded"
         id="m_datatable_latest_orders">
        <table class="table">
            <thead>
            <tr>
                <th>{{ __('STT') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Edit') }}</th>
                <th>{{ __('Delete') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($jobTypes as $key => $jobType)
                <tr>
                    @php $serial = $key + ($jobTypes->currentPage() - 1) * $jobTypes->perPage() + 1;@endphp
                    <td>{{ number_format($serial) }}</td>
                    <td>{{ $jobType->name }}</td>
                    <td>{{ $jobType->description }}</td>
                    <td>
                        <a href="{{ route('job-types.edit', $jobType->id) }}">
                            {{ __('Edit') }}
                        </a>
                    </td>
                    <td>
                        @include('elements.button_model', ['nameRoute' => 'job-types', 'data' => $jobType])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('elements.pagination', ['data' => $jobTypes])
@stop
