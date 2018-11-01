@extends('admin.layouts.base')
@section('base.title')
    {{ __('List Roles') }}
@endsection
@section('base.function')
    <a class="btn btn-success" href="{{ route('roles.create') }}">{{ __('Add New +') }}</a>
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
            @foreach ($roles as $key => $role)
                <tr>
                    @php $serial = $key + ($roles->currentPage() - 1) * $roles->perPage() + 1;@endphp
                    <td>{{ number_format($serial) }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}">
                            {{ __('Edit') }}
                        </a>
                    </td>
                    <td>
                        @include('elements.button_model', ['nameRoute' => 'roles.destroy', 'data' => $role])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('elements.pagination', ['data' => $roles])
@stop
