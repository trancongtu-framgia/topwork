<div class="gc_main_menu_wrapper">
    <div class="container">
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
            @if (Auth::check() && Auth::user()->userRole->name == config('app.company_role'))
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 center_responsive">
                    <div class="header-area hidden-menu-bar stick" id="sticker">
                        <!-- mainmenu start -->
                        <div class="mainmenu">
                            <ul class="float_left">
                                <li class="has-mega gc_main_navigation">
                                    <a href="{{ route('home.index') }}" class="gc_main_navigation"> {{ __('Home') }}&nbsp;
                                    </a>
                                    <!-- mega menu start -->
                                </li>
                                <li class="has-mega gc_main_navigation">
                                    <a href="{{ route('jobs.index') }}" class="gc_main_navigation"> {{ __('My Posted Jobs') }}&nbsp;
                                    </a>
                                </li>
                                <li class="has-mega gc_main_navigation">
                                    <a href="{{ route('application.getList', \Illuminate\Support\Facades\Auth::user()->token) }}" class="gc_main_navigation"> {{ __('Candidates') }}&nbsp;</a>
                                </li>
                            </ul>
                        </div>
                        <!-- mainmenu end -->
                    </div>
                    <div class="jp_navi_right_btn_wrapper">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="jp_navi_right_btn_wrapper">
                        <ul>
                            <li><a href="{{ route('jobs.create') }}"><i class="fa fa-plus-circle"></i>&nbsp; {{ __('Post a job') }}</a></li>
                        </ul>
                    </div>
                </div>
            @elseif (Auth::check() && Auth::user()->userRole->name == config('app.candidate_role'))
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 center_responsive">
                    <div class="header-area hidden-menu-bar stick" id="sticker">
                        <!-- mainmenu start -->
                        <div class="mainmenu">
                            <ul class="float_left">
                                <li class="has-mega gc_main_navigation">
                                    <a href="{{ route('home.index') }}" class="gc_main_navigation"> {{ __('Home') }}&nbsp;
                                    </a>
                                    <!-- mega menu start -->
                                </li>
                                <li class="has-mega gc_main_navigation">
                                    <a href="{{ route('applyjobs.index') }}" class="gc_main_navigation"> {{ __('Applied Jobs') }}&nbsp;
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- mainmenu end -->
                    </div>
                    <div class="jp_navi_right_btn_wrapper">

                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="jp_navi_right_btn_wrapper">
                        <ul>
                            <li>
                                <a href="{{ route('candidate.getInfo', ['token' => Auth::user()->token]) }}">
                                    <i class="fa fa-user"></i>&nbsp; {{ __('My Online CV') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @else
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 center_responsive">
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
                    <div class="jp_navi_right_btn_wrapper">
                    </div>
                </div>
                @endif
        <!-- mobile menu area end -->
        </div>
    </div>
</div>
