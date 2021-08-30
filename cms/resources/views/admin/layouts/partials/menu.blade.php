<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="user-info" style="height: 100px;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, .3)"></div>
            <div class="info-container">
                <div class="image pull-left">
                    <img src="/assets/admin/images/user.png" width="48" height="48" alt="User"/>
                </div>
                <div class="name" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>{!! trans("admin_menu.sign_out") !!}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="menu">
            <ul class="list">
                <li class="header"></li>
                <li class="{!! currentPageMenu(["*admin"]) !!}">
                    <a href="/admin">
                        <i class="material-icons">dashboard</i>
                        <span>{!! trans("admin_menu.dashboard") !!}</span>
                    </a>
                </li>

                @if(in_array('admin.page.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/pages*", '*admin/themes*']) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pages</i>
                            <span>{!! trans("admin_menu.pages") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/pages"]) !!}">
                                <a href="{!! route("admin.page.index") !!}">
                                    <span>{!! trans("admin_menu.pages_list") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.menu.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/menu*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">menu</i>
                            <span>{!! trans("admin_menu.menu") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/menu/*"]) !!}">
                                <a href="{!! route("admin.menu.index") !!}">
                                    <span>{!! trans("admin_menu.menu") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/menu-item*"]) !!}">
                                <a href="{!! route("admin.menu.item.index") !!}">
                                    <span>{!! trans("admin_menu.menu_item") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.banner.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/banner*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">image</i>
                            <span>{!! trans("admin_menu.banner") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/banner"]) !!}">
                                <a href="{!! route("admin.banner.index") !!}">
                                    <span>{!! trans("admin_menu.banner_index") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/banner/create"]) !!}">
                                <a href="{!! route("admin.banner.create") !!}">
                                    <span>{!! trans("admin_menu.banner_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.news.category.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/news-category*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">category</i>
                            <span>{!! trans("admin_menu.news_category") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/news-category"]) !!}">
                                <a href="{!! route("admin.news.category.index") !!}">
                                    <span>{!! trans("admin_menu.news_category") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/news-category/create"]) !!}">
                                <a href="{!! route("admin.news.category.create") !!}">
                                    <span>{!! trans("admin_menu.news_category_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.news.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/news", "*admin/news/create", "*admin/news/edit"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">list</i>
                            <span>{!! trans("admin_menu.news") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/news"]) !!}">
                                <a href="{!! route("admin.news.index") !!}">
                                    <span>{!! trans("admin_menu.news") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/news/create"]) !!}">
                                <a href="{!! route("admin.news.create") !!}">
                                    <span>{!! trans("admin_menu.news_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.product.types.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/product-type*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_balance</i>
                            <span>{!! trans("admin_menu.product_type") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/product-types"]) !!}">
                                <a href="{!! route("admin.product.types.index") !!}">
                                    <span>{!! trans("admin_menu.product_type") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/product-types/create"]) !!}">
                                <a href="{!! route("admin.product.types.create") !!}">
                                    <span>{!! trans("admin_menu.product_type_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.product.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/products*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_balance</i>
                            <span>{!! trans("admin_menu.product") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/products"]) !!}">
                                <a href="{!! route("admin.product.index") !!}">
                                    <span>{!! trans("admin_menu.product") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/products/create"]) !!}">
                                <a href="{!! route("admin.product.create") !!}">
                                    <span>{!! trans("admin_menu.product_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.contact.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/contact*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">contact_mail</i>
                            <span>{!! trans("admin_menu.contact") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/contact"]) !!}">
                                <a href="{!! route("admin.contact.index") !!}">
                                    <span>{!! trans("admin_menu.contact") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


                @if(in_array('admin.user.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/users*", '*admin/roles*']) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_box</i>
                            <span>{!! trans("admin_menu.users") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/users*"]) !!}">
                                <a href="{!! route("admin.user.index") !!}">
                                    <span>{!! trans("admin_menu.users") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/roles*"]) !!}">
                                <a href="{!! route("admin.role.index") !!}">
                                    <span>{!! trans("admin_menu.roles") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.system.edit', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/system*"]) !!}">
                        <a href="{!! route("admin.system.edit", '0110') !!}">
                            <i class="material-icons">settings</i>
                            <span>{!! trans("admin_menu.system") !!}</span>
                        </a>
                    </li>
                @endif

                <li class="{!! currentPageMenu(["*"]) !!} hidden">
                    <a></a>
                </li>
            </ul>
        </div>
        <div class="legal">
            <div class="copyright">
                &copy;{!! date("Y") !!} <a href="javascript:void(0);">Admin {{ config('app.name') }}</a>
            </div>
        </div>
    </aside>
</section>
