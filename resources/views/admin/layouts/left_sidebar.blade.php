<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
    <i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu"
         class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light "
         m-menu-vertical="1"
         m-menu-scrollable="0" m-menu-dropdown-timeout="500">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__section m-menu__section--first">
                <h4 class="m-menu__section-text">{{ __('Managements') }}</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('categories.index') }}" class="m-menu__link">
                    <span class="m-menu__link-text">{{ __('Category') }}</span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('skills.index') }}" class="m-menu__link">
                    <span class="m-menu__link-text">{{ __('Skill') }}</span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('locations.index') }}" class="m-menu__link">
                    <span class="m-menu__link-text">{{ __('Location') }}</span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('job-types.index') }}" class="m-menu__link">
                    <span class="m-menu__link-text">{{ __('Job Type') }}</span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{ route('roles.index') }}" class="m-menu__link">
                    <span class="m-menu__link-text">{{ __('Role') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
