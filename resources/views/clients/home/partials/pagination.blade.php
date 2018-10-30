@if ($jobs->lastPage() > 1)
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
    <div class="pager_wrapper gc_blog_pagination">
        <ul class="pagination">
            <li>
                <a href="{{ str_replace('/?', '?', $jobs->url($jobs->currentPage() - 1)) }}"
                   onclick="{{ ($jobs->currentPage() == 1) ? 'return false;' : '' }}"> {{ __('Priv') }}
                </a>
            </li>
            @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                <li class="{{ ($jobs->currentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ str_replace('/?', '?', $jobs->url($i)) }}">{{ $i }}</a>
                </li>
            @endfor
            <li>
                <a href="{{ $jobs->nextPageUrl() }}"
                   onclick="{{ ($jobs->currentPage() == $jobs->lastPage()) ? 'return false;' : '' }}"> {{ __('Next') }}
                </a>
            </li>
        </ul>
    </div>
</div>
@endif
