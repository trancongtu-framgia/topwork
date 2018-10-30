<div class="jp_tittle_main_wrapper">
    <div class="jp_tittle_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="jp_tittle_heading_wrapper">
                    <div class="jp_tittle_heading">
                        <h2>@yield('breadcrumb_title')</h2>
                    </div>
                    <div class="jp_tittle_breadcrumb_main_wrapper">
                        <div class="jp_tittle_breadcrumb_wrapper">
                            <ul>
                                <li><a href="{{ route('home.index') }}">{{ __('Home') }}</a><i class="fa fa-angle-right"></i></li>
                                @yield('breadcrumb_step')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
