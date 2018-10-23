@extends('admin.layouts.base');
@section('base.title')
    {{ __('List Location') }}
@endsection
@section('base.function')
    <a class="btn btn-success" href="{{ route('locations.create') }}">{{ __('Add New +') }}</a>
@endsection
@section('base.content')
    <div class="m_datatable m-datatable m-datatable--default m-datatable--error m-datatable--loaded"
         id="m_datatable_latest_orders">
        <table class="table">
            <thead>
            <tr>
                <th>{{ __('STT') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Edit') }}</th>
                <th>{{ __('Delete') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($locations as $key => $location)
                <tr>
                    @php $serial = $key + ($locations->currentPage() - 1) * $locations->perPage() + 1;@endphp
                    <td>{{ number_format($serial) }}</td>
                    <td>{{ $location->name }}</td>
                    <td>
                        <a href="{{ route('locations.edit', $location->id) }}">
                            {{ __('Edit') }}
                        </a>
                    </td>
                    <td>
                        @include('elements.button_model', ['nameRoute' => 'locations.destroy', 'data' => $location])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('elements.pagination', ['data' => $locations])
@stop
