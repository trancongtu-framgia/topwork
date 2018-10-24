@extends('clients.layouts.master')
@section('content')
    <div class="jp_cp_profile_main_wrapper content_client">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="jp_cp_left_side_wrapper">
                        <div class="jp_cp_left_pro_wallpaper">
                            <img src="{{ asset(config('app.client_media_url') . $data['logo']) }}" class="logo_company">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="jp_cp_right_side_wrapper">
                        <div class="jp_cp_right_side_inner_wrapper">
                            <h2 class="name_company">{{ $data['name'] }}</h2>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="td-w25 company"><i class="fa fa-map-marker"></i></td>
                                    <td class="td-w65">{{ $data['address'] }}</td>
                                </tr>
                                <tr>
                                    <td class="td-w25 company"><i class="fa fa-calendar"></i></td>
                                    <td class="td-w65">{{ $data['working_day'] }}</td>
                                </tr>
                                <tr>
                                    <td class="td-w25 company"><i class="fa fa-users"></i></td>
                                    <td class="td-w65">{{ $data['range'] }}</td>
                                </tr>
                                <tr>
                                    <td class="td-w25 company"><i class="fa fa-flag"></i></td>
                                    <td class="td-w65">{{ $data['country'] }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="jp_cp_accor_heading_wrapper">
                                <h2>{{ __('overview') }}</h2>
                                <p>
                                    {{ $data['description'] }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
