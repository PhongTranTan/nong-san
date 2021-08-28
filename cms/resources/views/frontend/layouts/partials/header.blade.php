<header class="header-page">
    <div class="wrap-sticky-header">
        <div class="backdrop"></div>
        <div class="container-max">
            <div class="mobile"><a class="btn-toggle-center" href="#"><span></span></a></div>
            <div class="left">
                <a class="logo" href="/">
                    <div class="img-bg lazy" data-src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}">
                        <img src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}" alt="{{ (isset($arr_setting['website_title'])) ? asset($arr_setting['website_title']) : 'NewLaunchPortal' }}">
                    </div>
                </a>
            </div>
            <div class="center">
                <div class="logo-center d-lg-none">
                    <a href="/" class="img-bg lazy" data-src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}">
                        <img src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}" alt="{{ (isset($arr_setting['website_title'])) ? asset($arr_setting['website_title']) : 'NewLaunchPortal' }}">
                    </a>
                    <a class="close"> </a>
                </div>
                <ul class="menu-left nav">
                    @foreach($composer_menu as $item_menu)
                        <li class="{{ request()->is(str_replace('/', '', $item_menu->url)) ? 'active' : '' }}">
                            <a class="{{ isset($item_menu->trees) && count($item_menu->trees) ? 'toggle-down' : null }}" href="{{ ($item_menu->url != '#' || $item_menu->url != null) ? $item_menu->url : 'javascript:void(0)' }}" title="{{ $item_menu->title }}" target="{{ $item_menu->target }}">@if($item_menu->url != '#' || $item_menu->url != null)<span class="text">@endif{{ $item_menu->title }}@if($item_menu->url != '#' || $item_menu->url != null)</span>@endif</a>
                            @if(isset($item_menu->trees) && count($item_menu->trees))
                                <ul class="dropdown-sub">
                                @foreach($item_menu->trees as $key => $menu_child)
                                    <li><a href="{{ ($menu_child->url != '#') ? $menu_child->url : 'javascript:void(0)' }}" target="{{ $item_menu->target }}">{{ $menu_child->title }}</a></li>
                                @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                    {{-- <li><a class="{{ request()->is(str_replace('/', '', getPageUrlByCode('ALL-PROJECTS'))) ? 'active' : '' }}" href="{{ getPageUrlByCode('ALL-PROJECTS') }}">{{ getPageTitleByCode('ALL-PROJECTS') }}</a></li>
                    <li><a class="{{ request()->is(str_replace('/', '', getPageUrlByCode('INVESTOR'))) ? 'active' : '' }}" href="{{ getPageUrlByCode('INVESTOR') }}">{{ getPageTitleByCode('INVESTOR') }}</a></li>
                    <li><a href="javascript:void(0)" class="toggle-down {{ request()->is(str_replace('/', '', getPageUrlByCode('HOME-LOAN'))) || request()->is(str_replace('/', '', getPageUrlByCode('MORTGAGE-INSURANCE'))) ? 'active' : '' }}">Services</a>
                        <ul class="dropdown-sub">
                            <li><a href="{{ getPageUrlByCode('HOME-LOAN') }}">{{ getPageTitleByCode('HOME-LOAN') }}</a></li>
                            <li><a href="{{ getPageUrlByCode('MORTGAGE-INSURANCE') }}">{{ getPageTitleByCode('MORTGAGE-INSURANCE') }}</a></li>
                        </ul>
                    </li>
                    <li><a class="{{ request()->is(str_replace('/', '', getPageUrlByCode('GUIDES'))) ? 'active' : '' }}" href="{{ getPageUrlByCode('GUIDES') }}">{{ getPageTitleByCode('GUIDES') }}</a></li>
                    <li><a class="{{ request()->is(str_replace('/', '', getPageUrlByCode('CONTACT'))) ? 'active' : '' }}" href="{{ getPageUrlByCode('CONTACT') }}">{{ getPageTitleByCode('CONTACT') }}</a></li> --}}
                </ul>
            </div>
            @include("frontend.layouts.partials.favorite")
        </div>
    </div>
</header>
@include("frontend.layouts.partials.popup-showflat")