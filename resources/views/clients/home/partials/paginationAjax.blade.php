@if ($jobs->lastPage() > 1)
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
    <div class="pager_wrapper gc_blog_pagination">
        <ul class="pagination">
            <li>
                <a href="javascript:void(0)"
                   onclick="{{ ($jobs->currentPage() == 1) ? 'return false;' : 'getJobByPaginate(' . ($jobs->currentPage() - 1) . ', ' . (isset($route) ? '\'' . $route . '\''  : '\'\'') . ')' }}"> {{ __('Priv') }}
                </a>
            </li>
            @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                <li class="{{ ($jobs->currentPage() == $i) ? 'active' : '' }}">
                    <a href="javascript:void(0)" onclick="getJobByPaginate({{ $i }}, '{{ isset($route) ? $route : '' }}')">
                        {{ $i }}
                    </a>
                </li>
            @endfor
            <li>
                <a href="javascript:void(0)"
                   onclick="{{ ($jobs->currentPage() == $jobs->lastPage()) ? 'return false;' : 'getJobByPaginate(' . ($jobs->currentPage() + 1) . ', ' . (isset($route) ? '\'' . $route . '\''  : '\'\'') . ')' }}"> {{ __('Next') }}
                </a>
            </li>
        </ul>
    </div>
</div>
@endif
