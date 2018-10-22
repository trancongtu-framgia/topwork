@extends('admin.layouts.base');
@section('base.content')
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Danh sách Job Type
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        
                    </div>
                </div>
            </div>
            @include('flash::message')
            <div class="tab-pane" id="m_widget11_tab2_content">
                <div class="m-widget11">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td class="m-widget11__label">{{ __('STT') }}</td>
                                    <td class="m-widget11__app">{{ __('Tên') }}</td>
                                    <td class="m-widget11__sales">{{ __('Ghi chú') }}</td>
                                    <td class="m-widget11__sales">{{ __('Sửa') }}</td>
                                    <td class="m-widget11__sales">{{ __('Xóa') }}</td>
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
                                        <a href="{{ route('job-type.edit', $jobType->id) }}">
                                            <span style="width: 95" class="btn btn-primary">Edit</span>
                                        </a>
                                    </td>
                                    <td>
                                        @include('elements.button_model', ['nameRoute' => 'job-type.destroy', 'record' => $jobType, 'colorButton' => 'danger', 'iconButton' => 'fa-trash-o', 'nameModal' => 'Delete'])
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-widget11__action m--align-right">
                        <a class="btn btn-primary" href="{{ route('job-type.create') }}">{{ __('Thêm mới') }}</a>
                    </div>
                </div>
            </div> 
        </div>
        @include('elements.pagination', ['data' => $jobTypes])
    </div>
@stop
