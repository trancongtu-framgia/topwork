@extends('admin.layouts.base')
@section('base.title')
    {{ __('Category List') }}
@endsection
@section('base.function')
    <a href="{{ route('skills.create') }}" class="btn btn-success">{{ __('Add New') }}</a>
@endsection
@section('base.content')
    <table class="table">
        <thead>
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('Skill Name') }}</th>
            <th>{{ __('Category') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($skills as $skill)
            <tr>
                <td>{{ $skill->id }}</td>
                <td>{{ $skill->name }}</td>
                <td>{{ $skill->skillCategory->name }}</td>
                <td>
                    <a href="{{ route('skills.edit', ['id' => $skill->id]) }}">{{ __('Edit') }}</a>
                </td>
                <td>
                    @include('elements.button_model', ['nameRoute' => 'skills.destroy', 'data' => $skill])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
     @include('elements.pagination', ['data' => $skills])
@stop
