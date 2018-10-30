<div class="jp_top_header_main_wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="jp_top_header_left_wrapper">
                    <div class="jp_top_header_left_cont">
                        <p><i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp;&nbsp;Topwork Inc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="jp_top_header_right_wrapper">

                    <div class="jp_top_header_right__social_cont">

                        <ul>
                            <li>
                                {!! Form::select('change_lang', [
                                        'vi' => 'Vi',
                                        'en' => 'En',
                                     ], session()->has('lang') ? session()->get('lang') : 'en', [
                                        'class' => 'selectpicker form-control mt-10',
                                        'id' => 'change_lang',
                                        'onChange' => 'changeLang(\'' . url('') . '\')',
                                     ]);
                                !!}
                            </li>
                            @auth
                                <li><a href="#" class="white_important">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                       onclick="logout('{{ __('content_logout') }}', '{{ __('cancel') }}', '{{ __('ok') }}');">
                                        {{ __('logout') }}
                                        <i class="glyphicon glyphicon-log-out"></i>
                                    </a>
                                    {!! Form::open([
                                            'route' => 'logout',
                                            'method' => 'post',
                                            'id' => 'logout-form',
                                        ])
                                    !!}
                                    {!! Form::close() !!}
                                </li>
                            @elseauth
                        </ul>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
