@extends('clients.layouts.master')
@section('content')
    <div class="jp_pricing_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="pricing_box1_wrapper pricing_border_box2_wrapper">
                        <div class="box1_heading_wrapper box2_heading_wrapper">
                            @if (!empty($msg))
                                <h4 class="red">{{ $msg }}</h4>
                            @endif
                        </div>
                        <div class="jp_pricing_label_wrapper">
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

