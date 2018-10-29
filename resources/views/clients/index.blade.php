@extends('clients.layouts.master')
@section('content')
    @include('clients.layouts.header')
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>{{__('Jobs by Category')}}</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                <p>
                                                    <input type="checkbox" id="c1" name="cb">
                                                    <label for="c1">Graphic Designer <span>(214)</span></label>

                                                <p>
                                                    <input type="checkbox" id="c2" name="cb">
                                                    <label for="c2">Engineering Jobs <span>(514)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c3" name="cb">
                                                    <label for="c3">Mainframe Jobs <span>(554)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c4" name="cb">
                                                    <label for="c4">Legal Jobs <span>(457)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c5" name="cb">
                                                    <label for="c5">IT Jobs <span>(1254)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c6" name="cb">
                                                    <label for="c6">R&D Jobs <span>(554)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c7" name="cb">
                                                    <label for="c7">Government Jobs <span>(350)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c8" name="cb">
                                                    <label for="c8">PSU Jobs <span>(221)</span></label>
                                                </p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><i class="fa fa-plus-circle"></i> <a href="#">SHOW MORE</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @include('clients.layouts.listWrapper')
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-content">
                                <div id="grid" class="tab-pane fade in active">
                                    <div class="row">
                                        @foreach($jobs as $job)
                                            @include('clients.home.partials.job_element_square')
                                        @endforeach
                                        @include('clients.home.partials.pagination')
                                    </div>
                                </div>
                                <div id="list" class="tab-pane fade">
                                    <div class="row">
                                        @foreach($jobs as $job)
                                            @include('clients.home.partials.job_element_retangle')
                                        @endforeach
                                        @include('clients.home.partials.pagination')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 visible-sm visible-xs">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>{{_('Jobs by Category')}}</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                <p>
                                                    <input type="checkbox" id="c101" name="cb">
                                                    <label for="c101">Graphic Designer <span>(214)</span></label>

                                                <p>
                                                    <input type="checkbox" id="c102" name="cb">
                                                    <label for="c102">Engineering Jobs <span>(514)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c103" name="cb">
                                                    <label for="c103">Mainframe Jobs <span>(554)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c104" name="cb">
                                                    <label for="c104">Legal Jobs <span>(457)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c105" name="cb">
                                                    <label for="c105">IT Jobs <span>(1254)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c106" name="cb">
                                                    <label for="c106">R&D Jobs <span>(554)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c107" name="cb">
                                                    <label for="c107">Government Jobs <span>(350)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c108" name="cb">
                                                    <label for="c108">PSU Jobs <span>(221)</span></label>
                                                </p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><i class="fa fa-plus-circle"></i> <a href="#">SHOW MORE</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 visible-sm visible-xs">
                            <div class="pager_wrapper gc_blog_pagination">
                                <ul class="pagination">
                                    <li><a href="#">Priv.</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li class="hidden-xs"><a href="#">4</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


