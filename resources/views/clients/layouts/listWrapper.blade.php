<div class="jp_listing_tabs_wrapper">
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
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
        <div class="gc_causes_search_box_wrapper gc_causes_search_box_wrapper2">
            <div class="gc_causes_search_box">
                <p>{!! __('You are Watching :firstItem to :lastItem',
                        [
                            'firstItem' => $jobs->firstItem(),
                            'lastItem' => $jobs->lastItem(),
                        ])
                    !!}
                </p>
            </div>
        </div>
    </div>
</div>
