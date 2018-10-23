@extends('admin.layouts.base');
@section('base.title')
    {{ __('Category List') }}
@endsection
@section('base.function')
    <a href="{{ route('categories.create') }}" class="btn btn-success">{{ __('Add New') }}</a>
@endsection
@section('base.content')
    <table class="table">
        <thead>
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('Category Name') }}</th>
            <th>{{ __('Description') }}</th>
            <th>{{ __('Parent Category') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->parent_category }}</td>
                <td>
                    <a href="{{ route('categories.edit', ['id' => $category->id]) }}">{{ __('Edit') }}</a>&nbsp;&nbsp;
                    {{ Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id]]) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('elements.pagination', ['data' => $categories])
@stop
