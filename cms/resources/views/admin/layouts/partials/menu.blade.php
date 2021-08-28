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

                @if(in_array('admin.project.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/project*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_balance</i>
                            <span>{!! trans("admin_menu.project") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/project"]) !!}">
                                <a href="{!! route("admin.project.index") !!}">
                                    <span>{!! trans("admin_menu.project") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/project/create"]) !!}">
                                <a href="{!! route("admin.project.create") !!}">
                                    <span>{!! trans("admin_menu.project_create") !!}</span>
                                </a>
                            </li>
                            <li clas="{!! currentPageMenu(["*admin/floor-category"]) !!}">
                                <a href="{!! route("admin.floorcategory.index") !!}">
                                    <span>{!! trans("admin_menu.floor_category") !!}</span>
                                </a>
                            </li>
                            <li clas="{!! currentPageMenu(["*admin/floor-category/create"]) !!}">
                                <a href="{!! route("admin.floorcategory.create") !!}">
                                    <span>{!! trans("admin_menu.floor_category_create") !!}</span>
                                </a>
                            </li>
                            <li clas="{!! currentPageMenu(["*admin/floor-type"]) !!}">
                                <a href="{!! route("admin.floortype.index") !!}">
                                    <span>{!! trans("admin_menu.floor_type") !!}</span>
                                </a>
                            </li>
                            <li clas="{!! currentPageMenu(["*admin/floor-type/create"]) !!}">
                                <a href="{!! route("admin.floortype.create") !!}">
                                    <span>{!! trans("admin_menu.floor_type_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.linkreport.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/linkreport*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">image</i>
                            <span>{!! trans("admin_menu.linkreport") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/linkreport"]) !!}">
                                <a href="{!! route("admin.linkreport.index") !!}">
                                    <span>{!! trans("admin_menu.linkreport_index") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/linkreport/create"]) !!}">
                                <a href="{!! route("admin.linkreport.create") !!}">
                                    <span>{!! trans("admin_menu.linkreport_create") !!}</span>
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

                @if(in_array('admin.logopartner.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/partner*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">extension</i>
                            <span>{!! trans("admin_menu.partner") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/partner"]) !!}">
                                <a href="{!! route("admin.logopartner.index") !!}">
                                    <span>{!! trans("admin_menu.partner") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/partner/create"]) !!}">
                                <a href="{!! route("admin.logopartner.create") !!}">
                                    <span>{!! trans("admin_menu.partner_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.guides.category.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/guides-category*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">featured_play_list</i>
                            <span>{!! trans("admin_menu.guides_category") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/guides-category"]) !!}">
                                <a href="{!! route("admin.guides.category.index") !!}">
                                    <span>{!! trans("admin_menu.guides_category") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/guides-category/create"]) !!}">
                                <a href="{!! route("admin.guides.category.create") !!}">
                                    <span>{!! trans("admin_menu.guides_category_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.guides.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/guides", "*admin/guides/create"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">art_track</i>
                            <span>{!! trans("admin_menu.guides") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/guides"]) !!}">
                                <a href="{!! route("admin.guides.index") !!}">
                                    <span>{!! trans("admin_menu.guides") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/guides/create"]) !!}">
                                <a href="{!! route("admin.guides.create") !!}">
                                    <span>{!! trans("admin_menu.guides_create") !!}</span>
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

                @if(in_array('admin.siborrates.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/sibor-rates*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">queue</i>
                            <span>{!! trans("admin_menu.sibor_rates") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/sibor-rates"]) !!}">
                                <a href="{!! route("admin.siborrates.index") !!}">
                                    <span>{!! trans("admin_menu.sibor_rates") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/sibor-rates/create"]) !!}">
                                <a href="{!! route("admin.siborrates.create") !!}">
                                    <span>{!! trans("admin_menu.sibor_rates_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.mortgage.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/mortgage-rates*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">device_hub</i>
                            <span>{!! trans("admin_menu.mortgage") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/mortgage-rates"]) !!}">
                                <a href="{!! route("admin.mortgage.index") !!}">
                                    <span>{!! trans("admin_menu.mortgage") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/mortgage-rates/create"]) !!}">
                                <a href="{!! route("admin.mortgage.create") !!}">
                                    <span>{!! trans("admin_menu.mortgage_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.testimonials.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/testimonials*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">question_answer</i>
                            <span>{!! trans("admin_menu.testimonials") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/testimonials"]) !!}">
                                <a href="{!! route("admin.testimonials.index") !!}">
                                    <span>{!! trans("admin_menu.testimonials") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/testimonials/create"]) !!}">
                                <a href="{!! route("admin.testimonials.create") !!}">
                                    <span>{!! trans("admin_menu.testimonials_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.district.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/district*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>{!! trans("admin_menu.district") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/district"]) !!}">
                                <a href="{!! route("admin.district.index") !!}">
                                    <span>{!! trans("admin_menu.district") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/district/create"]) !!}">
                                <a href="{!! route("admin.district.create") !!}">
                                    <span>{!! trans("admin_menu.district_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.tenure.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/tenure*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">book</i>
                            <span>{!! trans("admin_menu.tenure") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/tenure"]) !!}">
                                <a href="{!! route("admin.tenure.index") !!}">
                                    <span>{!! trans("admin_menu.tenure") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/tenure/create"]) !!}">
                                <a href="{!! route("admin.tenure.create") !!}">
                                    <span>{!! trans("admin_menu.tenure_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.purpose.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/purpose*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">book</i>
                            <span>{!! trans("admin_menu.purpose") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/purpose"]) !!}">
                                <a href="{!! route("admin.purpose.index") !!}">
                                    <span>{!! trans("admin_menu.purpose") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/purpose/create"]) !!}">
                                <a href="{!! route("admin.purpose.create") !!}">
                                    <span>{!! trans("admin_menu.purpose_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.direction.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/direction*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>{!! trans("admin_menu.direction") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/direction"]) !!}">
                                <a href="{!! route("admin.direction.index") !!}">
                                    <span>{!! trans("admin_menu.direction") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/direction/create"]) !!}">
                                <a href="{!! route("admin.direction.create") !!}">
                                    <span>{!! trans("admin_menu.direction_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.type.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/type*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>{!! trans("admin_menu.type") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/type"]) !!}">
                                <a href="{!! route("admin.type.index") !!}">
                                    <span>{!! trans("admin_menu.type") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/type/create"]) !!}">
                                <a href="{!! route("admin.type.create") !!}">
                                    <span>{!! trans("admin_menu.type_create") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.budgets.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/budgets*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>{!! trans("admin_menu.budgets") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/budgets"]) !!}">
                                <a href="{!! route("admin.budgets.index") !!}">
                                    <span>{!! trans("admin_menu.budgets") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.schedule.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/schedule*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">cloud</i>
                            <span>{!! trans("admin_menu.schedule") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/schedule"]) !!}">
                                <a href="{!! route("admin.schedule.index") !!}">
                                    <span>{!! trans("admin_menu.schedule") !!}</span>
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

                @if(in_array('admin.subscribe.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/subscribe*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">contact_mail</i>
                            <span>{!! trans("admin_menu.subscribe") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/subscribe"]) !!}">
                                <a href="{!! route("admin.subscribe.index") !!}">
                                    <span>{!! trans("admin_menu.subscribe") !!}</span>
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
