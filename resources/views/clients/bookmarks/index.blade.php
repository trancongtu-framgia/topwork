@extends('clients.layouts.master')
@section('content')
    <div class="jp_pricing_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="pricing_box1_wrapper pricing_border_box2_wrapper">
                        <div class="box1_heading_wrapper box2_heading_wrapper">
                            <h4>{{ __('Area of Interesting') }}</h4>
                        </div>
                        {{ Form::open(['url' => route('bookmarks.store'), 'method' => 'POST', 'class' => 'form-horizontal form-label-left', 'id' => 'postForm']) }}
                        <div class="pricing_cont_wrapper">
                            <div class="pricing_cont handyman_sec1_wrapper">
                                <ul>
                                    @foreach ($categories as $key => $category)
                                    <li>
                                        <p>
                                            {!! Form::checkbox('cb[]', $key, null, ['id' => $key]) !!}
                                            {!! Form::label($key, $category) !!}
                                        </p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="pricing_btn_wrapper">
                            <div class="pricing_btn2">
                                <ul>
                                    <li><a id="postBookMark" href="#"><i class=" btn-primary login_btn"></i>{{ __('Save') }}</a></li>
                                </ul>
                            </div>
                        </div>
                        {{ Form::close() }}
                        <div class="jp_pricing_label_wrapper">
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_client')
    <script>
        $(document).ready(function () {
            $('#postBookMark').click(function () {
                $('#postForm').submit();
            });
        })
    </script>
@endsection
