<div class="gc_main_menu_wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-xs hidden-sm full_width">
                <div class="gc_header_wrapper">
                    <div class="gc_logo">
                        <a href="/"><img src="{{ asset(config('app.media_url') . 'logo2.png') }}" alt="Logo" title="Job Pro"
                                         class="img-responsive"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 center_responsive">
                <div class="header-area hidden-menu-bar stick" id="sticker">
                    <!-- mainmenu start -->
                    <div class="mainmenu">
                        <ul class="float_left">
                            <li class="has-mega gc_main_navigation">
                                <a href="#" class="gc_main_navigation"> {{ __('Home') }}&nbsp;<i
                                        class="fa fa-angle-down"></i></a>
                                <!-- mega menu start -->
                                <ul>
                                    <li class="parent"><a href="index.html">{{ __('Home1') }}</a></li>
                                    <li class="parent"><a href="index_II.html">{{ __('Home2') }}</a></li>
                                    <li class="parent"><a href="index_map.html">{{ __('Home3') }}</a></li>
                                </ul>
                            </li>
                            <li>
                                {!! Form::select('change_lang',
                                         [
                                            'vi' => 'Vi',
                                            'en' => 'En',
                                         ],
                                          session()->has('lang') ? session()->get('lang') : 'en',
                                         [
                                            'class' => 'selectpicker form-control',
                                            'id' => 'change_lang',
                                            'onChange' => 'changeLang(\'' .url(''). '\')',
                                         ]);
                                !!}
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
                        <li><a href="/register"><i class="fa fa-user"></i>&nbsp;{{ __('sign up') }} </a></li>
                        <li><a href="/login"><i class="fa fa-sign-in"></i>&nbsp; {{ __('login') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



