@extends('clients.layouts.master')
@section('content')
    @include('clients.layouts.header')
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_listing_heading_wrapper">
                        <h2>We found <span>357</span> Matches for you.</h2>
                    </div>
                </div>
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
                            <div class="jp_listing_tabs_wrapper">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="gc_causes_select_box_wrapper">
                                        <div class="gc_causes_select_box">
                                            <select>
                                                <option>Sort Default</option>
                                                <option>Sort Default</option>
                                                <option>Sort Default</option>
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="gc_causes_view_tabs_wrapper">
                                        <div class="gc_causes_view_tabs">
                                            <ul class="nav nav-pills">
                                                <li class="active">
                                                    <a data-toggle="pill" href="#grid"><i class="fa fa-th-large"></i></a>
                                                </li>
                                                <li>
                                                    <a data-toggle="pill" href="#list"><i class="fa fa-list"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="gc_causes_search_box_wrapper gc_causes_search_box_wrapper2">
                                        <div class="gc_causes_search_box">
                                            <p>You're Watching &nbsp;<span>01 to 20</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-content">
                                <div id="grid" class="tab-pane fade in active">
                                    <div class="row">
                                        @foreach(range(1,12) as $row)
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                    <div class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="jp_job_post_side_img">
                                                                    <img src="assets/clients/images/content/job_post_img5.jpg" alt="post_img" />
                                                                </div>
                                                                <div class="jp_job_post_right_cont jp_job_post_grid_right_cont">
                                                                    <h4>HTML Developer (1 - 2 Yrs Exp.)</h4>
                                                                    <p>Webstrot Technology Pvt. Ltd.</p>
                                                                    <ul>
                                                                        <li><i class="fa fa-cc-paypal"></i>&nbsp; $12K - 15k P.A.</li>
                                                                        <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="jp_job_post_right_btn_wrapper jp_job_post_grid_right_btn_wrapper">
                                                                    <ul>
                                                                        <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                                                        <li><a href="#">Part Time</a></li>
                                                                        <li><a href="#">Apply</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="jp_job_post_keyword_wrapper">
                                                        <ul>
                                                            <li><i class="fa fa-tags"></i>Keywords :</li>
                                                            <li><a href="#">ui designer,</a></li>
                                                            <li><a href="#">developer,</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
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
                                <div id="list" class="tab-pane fade">
                                    <div class="row">
                                        @foreach(range(1,12) as $row)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                <div class="jp_job_post_main_wrapper">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="jp_job_post_side_img">
                                                                <img src="assets/clients/images/content/job_post_img5.jpg" alt="post_img" />
                                                            </div>
                                                            <div class="jp_job_post_right_cont">
                                                                <h4>HTML Developer (1 - 2 Yrs Exp.)</h4>
                                                                <p>Webstrot Technology Pvt. Ltd.</p>
                                                                <ul>
                                                                    <li><i class="fa fa-cc-paypal"></i>&nbsp; $12K - 15k P.A.</li>
                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="jp_job_post_right_btn_wrapper">
                                                                <ul>
                                                                    <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                                                    <li><a href="#">Part Time</a></li>
                                                                    <li><a href="#">Apply</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="jp_job_post_keyword_wrapper">
                                                    <ul>
                                                        <li><i class="fa fa-tags"></i>Keywords :</li>
                                                        <li><a href="#">ui designer,</a></li>
                                                        <li><a href="#">developer,</a></li>
                                                        <li><a href="#">senior</a></li>
                                                        <li><a href="#">it company,</a></li>
                                                        <li><a href="#">design,</a></li>
                                                        <li><a href="#">call center</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
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


