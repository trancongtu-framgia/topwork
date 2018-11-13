<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="utf-8"/>
    <title>Top work</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="Job Pro"/>
    <meta name="keywords" content="Job Pro"/>
    <meta name="author" content=""/>
    <meta name="MobileOptimized" content="320"/>
    <!--srart theme style -->
    @include('clients.layouts.css')
<!-- favicon links -->
    <link rel="shortcut icon" type="image/png" href="assets/clients/images/header/favicon.ico"/>
</head>
<body>
<div id="preloader">
    <div id="status"><img src="{{ asset(config('app.client_media_url') . 'loadinganimation.gif') }}" id="preloader_image" alt="loader">
    </div>
</div>
@if (Route::currentRouteName() != 'home.index')
<a href="javascript:void(0)" class="btn-back" onclick="goBack()">
    <i class="fa fa-chevron-left my-float"></i>
</a>
@endif
@include('clients.layouts.top_header')
<div class="jp_top_header_img_wrapper">
    @includeWhen(Auth::check(), 'clients.layouts.nav')
    @includeWhen(!Auth::check(), 'clients.layouts.nav_not_auth')
</div>
@yield('content')
<div class="jp_main_footer_img_wrapper">
    @include('clients.layouts.footer')
</div>
@include('clients.layouts.js')
@include('clients.layouts.company_notification_js')
</body>
</html>


