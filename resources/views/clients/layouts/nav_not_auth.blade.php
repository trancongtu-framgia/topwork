<div class="gc_main_menu_wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-xs hidden-sm full_width">
                <div class="gc_header_wrapper">
                    <div class="gc_logo">
                        <a href="{{ route('home.index') }}">
                            <img src="{{ asset(config('app.client_media_url') . 'logo.png') }}" class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 center_responsive">
                <div class="header-area hidden-menu-bar stick" id="sticker">
                    <!-- mainmenu start -->
                    <div class="mainmenu">
                        <ul class="float_left">
                            <li class="has-mega gc_main_navigation">
                                <a href="{{ route('home.index') }}" class="gc_main_navigation"> {{ __('Home') }}&nbsp;
                                </a>
                                <!-- mega menu start -->
                            </li>
                        </ul>
                    </div>
                    <!-- mainmenu end -->
                </div>
            </div>
            <!-- mobile menu area end -->
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                <div class="jp_navi_right_btn_wrapper">
                    <ul>
                        <li>
                            <a href="{{ url('/register') }}" class="button-header">
                                <i class="fa fa-user"></i>&nbsp;{{ __('sign up') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/login') }}" class="button-header">
                                <i class="fa fa-sign-in"></i>&nbsp; {{ __('login') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
