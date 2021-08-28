{{-- <footer class="footer-page footer-detail-page section fp-auto-height footer-project-detail">
    <div class="container p-3">
        <div class="row">
            <div class="col-lg-3 col-md-6">        
                <div class="content-left"><a class="logo" href="/">
                        <div class="img-bg lazy" data-src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}"><img src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}" alt="{{ (isset($arr_setting['website_title'])) ? asset($arr_setting['website_title']) : 'NewLaunchPortal' }}"></div></a>
                    <div class="block-quote mg-top-20">{!! (isset($arr_setting['description_footer'])) ? str_replace("\r\n", "<br/>", $arr_setting['description_footer']) : null !!}</div>
                    <ul class="team-social nav">
                        <li><a href="{{ (isset($arr_setting['facebook'])) ? $arr_setting['facebook'] : '#' }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ (isset($arr_setting['linkedin'])) ? $arr_setting['linkedin'] : '#' }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="{{ (isset($arr_setting['youtube'])) ? $arr_setting['youtube'] : '#' }}" target="_blank"><i class="fa fa-youtube-play"> </i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-6">
                <div class="content-mid">
                    <div class="title-footer font-weight-700">MENU
                        <ul class="bullet-square mg-top-20 nav-footer">
                            <li><a href="{{ getPageUrlByCode('LIST-PROJECT') }}">All New Launches</a></li>
                            <li><a href="{{ getPageUrlByCode('INVESTOR') }}">For Investors</a></li>
                            <li> <a href="{{ getPageUrlByCode('HOME-LOAN') }}">Services</a></li>
                            <li><a href="{{ getPageUrlByCode('GUIDES') }}">Guides                 </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-6">
                <div class="content-right">
                    <div class="title-footer font-weight-700">CONTACT
                        <ul class="bullet-square mg-top-20">
                        <li><i class="icon icon-marker"></i><a href="{{ (isset($arr_setting['map_desktop'])) ? $arr_setting['map_desktop'] : '#' }}">{{ (isset($arr_setting['address'])) ? $arr_setting['address'] : null }}</a></li>
                        <li><i class="icon icon-call"></i>@if($arr_setting['phone'])<a href="tel:{{ $arr_setting['phone'] }}">{{ $arr_setting['phone'] }}</a>@endif</li>
                        <li> <i class="icon icon-mail"></i>@if($arr_setting['email'])<a href="mailto:{{ $arr_setting['email'] }}">{{ $arr_setting['email'] }}</a>@endif</li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="open-navSide">
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3">  </div>
</div> --}}

<footer class="fp-auto-height pdetail-footer footer-page" data-anchor="footer">
    <div class="container p-3">
        <div class="row">
            <div class="col-lg-3 col-md-6">        
                <div class="content-left"><a class="logo" href="{{ url('/') }}">
                        <div class="img-bg lazy" data-src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}"><img src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}" alt="{{ (isset($arr_setting['website_title'])) ? asset($arr_setting['website_title']) : 'NewLaunchPortal' }}"></div></a>
                    <div class="block-quote mg-top-20">{!! (isset($arr_setting['description_footer'])) ? str_replace("\r\n", "<br/>", $arr_setting['description_footer']) : null !!}</div>
                    <ul class="team-social nav">
                        <li><a href="{{ (isset($arr_setting['facebook'])) ? $arr_setting['facebook'] : '#' }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ (isset($arr_setting['linkedin'])) ? $arr_setting['linkedin'] : '#' }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="{{ (isset($arr_setting['youtube'])) ? $arr_setting['youtube'] : '#' }}" target="_blank"><i class="fa fa-youtube-play"> </i></a></li>
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
                            {{-- <li><a href="{{ getPageUrlByCode('LIST-PROJECT') }}">All New Launches</a></li>
                            <li><a href="{{ getPageUrlByCode('INVESTOR') }}">For Investors</a></li>
                            <li> <a href="{{ getPageUrlByCode('HOME-LOAN') }}">Services</a></li>
                            <li><a href="{{ getPageUrlByCode('GUIDES') }}">Guides                 </a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-6">
                <div class="content-right">
                    <div class="title-footer font-weight-700">CONTACT</div>
                    <ul class="bullet-square mg-top-20">
                        <li><i class="icon icon-marker"></i><a href="{{ (isset($arr_setting['map_desktop'])) ? $arr_setting['map_desktop'] : '#' }}">{{ (isset($arr_setting['address'])) ? $arr_setting['address'] : null }}</a></li>
                        <li><i class="icon icon-call"></i>@if($arr_setting['phone'])<a href="tel:{{ $arr_setting['phone'] }}">{{ $arr_setting['phone'] }}</a>@endif</li>
                        <li> <i class="icon icon-mail"></i>@if($arr_setting['email'])<a href="mailto:{{ $arr_setting['email'] }}">{{ $arr_setting['email'] }}</a>@endif</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- PDETAIL: CONTROL-->
<div class="pdetail-control">
    {{-- <div class="container-fluid footer-btn hide-element-on-keyboard" id="btn-foot">                       
        <button class="btn-nlp blue" data-toggle="modal" data-target="#modalPopovers">Schedule Showflat Tour</button>
        <button class="btn-nlp green" onclick="window.location.href='https://wa.me/{{ (isset($arr_setting['phone'])) ? $arr_setting['phone'] : '#' }}'">WhatsApp</button>
    </div> --}}
    <div class="back-top" id="gotoTop"><span><i class="icon icon-to-top"></i></span></div>
</div>
<!-- PDETAIL: navside-toogle-->