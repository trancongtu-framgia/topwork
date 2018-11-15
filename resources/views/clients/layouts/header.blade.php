<div class="jp_bottom_footer_Wrapper_header_img_wrapper">
    <div class="jp_slide_img_overlay"></div>
    <div class="jp_banner_heading_cont_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_job_heading_wrapper">
                        <div class="jp_job_heading">
                            <h1 class="title-header">{{ __('Many Jobs are waiting for you !') }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_header_form_wrapper">
                        {!! Form::open(['route' => 'home.search', 'method' => 'GET', 'id' => 'form_search']) !!}
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            {!! Form::text('keyword',
                                (isset($_GET['keyword']) && $_GET['keyword'] != '') ? $_GET['keyword'] : '' ,
                                [
                                    'type' => 'search',
                                    'class' => 'form-control',
                                    'placeholder' => __('keyword_search'),
                                    'autocomplete' => 'off',
                                    'id' => 'search-input',
                                ])
                            !!}
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="jp_form_location_wrapper">
                                <i class="fa fa-dot-circle-o first_icon"></i>
                                @php
                                    $locationValue = null;
                                        if (isset($_GET['location']) && $_GET['location'] != '') {
                                            if (array_key_exists($_GET['location'], $location->toArray())) {
                                                $locationValue = $_GET['location'];
                                            }
                                        }
                                @endphp
                                {!! Form::select('location', $location , $locationValue,
                                        [
                                            'placeholder' => __('Pick a location'),
                                            'id' => 'location-search',
                                        ]);
                                 !!}
                                <i class="fa fa-angle-down second_icon"></i>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <div class="jp_form_btn_wrapper">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)" id="btn-search-client">
                                            <i class="fa fa-search"></i> {{ __('search') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_banner_main_jobs_wrapper">
                        <div class="jp_banner_main_jobs">
                            <ul>
                                <li class="slogan">Do IT Awesome !</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
