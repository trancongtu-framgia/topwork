<div class="pop-up" id="pop-up-box">
    <div class="pop-up-content">
        <div>
            <h2 class="title-pop-up">{{ __('What category are you interesting?') }}</h2>
        </div>
        @php
            function checkActiveCategory ($category, $categoryBookmaks) {
                if ($categoryBookmaks) {
                    $array_name = [];
                    foreach ($categoryBookmaks as $key => $value) {
                        $array_name[] = $key;
                        if ($category == $key) {
                            return true;
                        }
                    }
                }
            }
        @endphp
        <div class="pricing_cont_wrapper">
            <div class="pricing_cont handyman_sec1_wrapper" >
                <div class="book-mark-list-category">
                    <ul>
                        @foreach ($categories as $key => $category)
                            <li>
                                <p>
                                    {!! Form::checkbox('cb', $key, checkActiveCategory($key, isset($categoriesByBookMarks) ? $categoriesByBookMarks : '') ? true : false, ['id' => $key]) !!}
                                    {!! Form::label($key, $category) !!}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="pricing_btn_wrapper">
            <div class="pricing_btn2">
                <ul>
                    <li><a id="postBookMark"><i class=" btn-primary login_btn"></i>{{ __('Save') }}</a></li>
                </ul>
            </div>
            <div>
                <a class="exit">{{ __('Skip') }}</a>
            </div>
        </div>
    </div>
</div>
