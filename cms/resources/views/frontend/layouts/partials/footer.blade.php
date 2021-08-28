          
    <div class="container p-3">
        <div class="row">
            <div class="col-lg-3 col-md-6">        
                <div class="content-left"><a class="logo" href="/">
                        <div class="img-bg lazy" data-src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}"><img src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}" alt="{{ (isset($arr_setting['website_title'])) ? asset($arr_setting['website_title']) : 'NewLaunchPortal' }}"></div></a>
                    <div class="block-quote mg-top-20">{!! (isset($arr_setting['description_footer'])) ? str_replace("\r\n", "<br/>", $arr_setting['description_footer']) : null !!}</div>
                    <ul class="team-social nav">
                        @if($arr_setting['facebook'] != null)<li><a href="{{ $arr_setting['facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a></li>@endif
                        @if($arr_setting['linkedin'] != null)<li><a href="{{ $arr_setting['linkedin'] }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>@endif
                        @if($arr_setting['youtube'] != null)<li><a href="{{ $arr_setting['youtube'] }}" target="_blank"><i class="fa fa-youtube-play"> </i></a></li>@endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-6">
                <div class="content-mid">
                    <div class="title-footer font-weight-700">MENU
                        <ul class="bullet-square mg-top-20 nav-footer">
                            @foreach($composer_footer as $item_footer)
                                <li><a href="{{ ($item_footer->url != '#') ? $item_footer->url : 'javascript:void(0)' }}">{{ $item_footer->title }}</a></li>
                            @endforeach
                            {{-- <li><a href="{{ getPageUrlByCode('ALL-PROJECTS') }}">{{ getPageTitleByCode('ALL-PROJECTS') }}</a></li>
                            <li><a href="{{ getPageUrlByCode('INVESTOR') }}">{{ getPageTitleByCode('INVESTOR') }}</a></li>
                            <li> <a href="{{ getPageUrlByCode('HOME-LOAN') }}">{{ getPageTitleByCode('HOME-LOAN') }}</a></li>
                            <li><a href="{{ getPageUrlByCode('GUIDES') }}">{{ getPageTitleByCode('GUIDES') }}</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-6">
                <div class="content-right">
                    <div class="title-footer font-weight-700">CONTACT</div>
                    <ul class="bullet-square mg-top-20">
                        @if($arr_setting['map_desktop'] != null)<li><i class="icon icon-marker-green"></i><a href="{{ $arr_setting['map_desktop'] }}">{{ (isset($arr_setting['address'])) ? $arr_setting['address'] : null }}</a></li>@endif
                        @if($arr_setting['phone'] != null)<li><i class="icon icon-call"></i><a href="tel:{{ $arr_setting['phone'] }}">{{ $arr_setting['phone'] }}</a></li>@endif
                        @if($arr_setting['email'] != null)<li> <i class="icon icon-mail"></i><a href="mailto:{{ $arr_setting['email'] }}">{{ $arr_setting['email'] }}</a></li>@endif
                    </ul>
                </div>
            </div>
        </div>
    </div>