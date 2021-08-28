@extends('frontend.layouts.master')

@push('style')
<link href="{{ asset('assets/css/styles_homepage.css') }}" rel="stylesheet">
@endpush

@section('class-home')
header-mb-transparent
@endsection

@section('content')
<main class="wrapper">
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section"></div>
        <div class="loader-icon horizontal">
            <div class="logo horizontal">
                <div class="img-bg" style="background-image: url({{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }})">
                    <img src="{{ (isset($arr_setting['logo'])) ? asset($arr_setting['logo']) : asset('images/logo.png') }}" alt="{{ (isset($arr_setting['website'])) ? $arr_setting['website'] : 'NewLaunchPortal' }}">
                </div>
            </div>
        </div>
    </div>
    <div class="page-internal-wrapper">
        <!-- HOME: BANNER-->
        <section class="banner-page-small">
            <div class="slider-slick">
                @if(isset($banners) && count($banners) > 0)
                @foreach($banners as $banner) 
                <div class="slick-slide">
                    <div class="img-bg" style="background-image:url('{{ $banner->image }}');"><img src="{{ $banner->image }}" alt="{{ $banner->title }}"></div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="overlay-dark"> </div>
            <div class="container text-center">
                <form class="form-filter-home" action="{{ route('search.index') }}">
                    <h1 class="banner-title" style="z-index:2">I am looking at a property for 
                        <select class="select-ui-multi type-home" multiple="multiple" data-placeholder="purpose" tabindex="1" name="purpose[]"> 
                            @if(count($purposes) > 0)
                                @foreach($purposes as $purpose)   
                                <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </h1>
                    <h1 class="banner-title">with a 
                        <select class="select-ui-multi type-home" multiple="multiple" data-placeholder="tenure" tabindex="1" name="tenure[]">
                        @if(count($tenures) > 0)
                            @foreach($tenures as $tenure)   
                            <option value="{{ $tenure->id }}">{{ $tenure->name }}</option>
                            @endforeach
                        @endif
                        </select>&nbsp; in 
                        <select class="select-ui-multi type-home" multiple="multiple" data-placeholder="location" tabindex="1" name="direction[]"> 
                        @if(count($directions) > 0)
                            @foreach($directions as $direction)
                            <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                            @endforeach
                        @endif
                        </select>
                    </h1>
                    <button class="btn-nlp big blue" type="submit" name="submit">Show my results</button>
                </form>
            </div>
            @if(!empty($blocks['HOME-INTRO-CONTENT']) && $block_home_intro = $blocks->get('HOME-INTRO-CONTENT')->first())
            <div class="overlay-dark-bottom">
                <div class="container">
                    <div class="intro-content">

                    @if(isset($block_home_intro->children) && count($block_home_intro->children) > 0)
                        @php $a = 0 @endphp
                        @foreach($block_home_intro->children as $key_home_intro => $home_intro)
                        @if($a % 3 ==1)
                            @php $icon = 'icon-user' @endphp
                        @elseif($a % 3 == 2)
                            @php $icon = 'icon-handshake' @endphp
                        @else
                            @php $icon = 'icon-thumb' @endphp
                        @endif
                        <div class="item-intro"><i class="icon {{ $icon }}"></i><span> {{ $home_intro->name }} </span></div>
                        @php $a++ @endphp
                        @endforeach
                    @endif

                    </div>
                </div>
            </div>
            @endif
        </section>

        <!-- SECTION EXPLORE-->
        <section class="explore-section bg-section">
            <div class="container">
                <div class="box-border">
                    @if(!empty($blocks['HOME-EXPLORE']) && $blocks->get('HOME-EXPLORE')->first())
                    <h2 class="title big text-center">{!! $blocks['HOME-EXPLORE'][0]->name !!}</h2>
                    @endif
                </div>
            </div>
            @if(!empty($blocks['HOME-EXPLORE']) && $block_explore = $blocks->get('HOME-EXPLORE')->first())
            <div class="cat-section container">
                <div class="cat-explore swiper-container">
                    <div class="grid-cat swiper-wrapper">
                        <div class="grid-sizer"></div>
                        @if(isset($block_explore->children) && count($block_explore->children) > 0)

                            @foreach($block_explore->children as $key_block_explore => $explore)
                            @php
                                $class_addon = null;
                            @endphp

                            @if($explore->code == 'VERTICAL')
                                @php $class_addon = 'size-vertical' @endphp
                            @elseif($explore->code == 'HORIZONTAL')
                                @php $class_addon = 'size-horizontal' @endphp
                            @endif
                            <div class="grid-item {{ $class_addon }} swiper-slide">
                                <div class="item-img">                                
                                    <a class="img-bg lazy" href="{{ $explore->url }}" style="background-image:url({{ $explore->photo }})"> <img src="{{ $explore->photo }}" alt="{{ $explore->name }}">
                                        <div class="dark-layer"></div>
                                        <div class="title">{{ $explore->name }}</div>
                                    </a>
                                </div>
                            </div>
                            @endforeach

                        @endif
                    </div>
                </div>
                <div class="swiper-scrollbar"></div>
            </div>
            @endif
        </section>

        <!-- SECTION SERVICES-->
        <section class="services-section">
            <div class="container">
                <div class="box-border">
                    @if(!empty($blocks['HOME-SERVICE']) && $blocks->get('HOME-SERVICE')->first())
                    <h2 class="title big text-center">{!! $blocks['HOME-SERVICE'][0]->name !!}</h2>
                    @endif
                </div>
            </div>
            @if(!empty($blocks['HOME-SERVICE']) && $block_service = $blocks->get('HOME-SERVICE')->first())
            <div class="services-content container">
                <div class="row swiper-container">
                    <div class="swiper-wrapper">
                        @if(isset($block_service->children) && count($block_service->children) > 0)
                            @foreach($block_service->children as $key_service => $service)

                            <div class="col-lg-6 inner-services swiper-slide">
                                <a class="info-inner-services" href="{{ $service->url }}">
                                    <div class="img-bg" style="background-image:url({{ asset($service->photo) }})"><img src="images/services1.png" alt="{!! $service->name !!}"></div>
                                    <div class="info">
                                        <p class="s-title">{!! $service->name !!}</p>
                                        <p class="s-desc scroll-text">{!! $service->description !!}</p>
                                        <button class="btn-nlp btn-light" onclick="window.location.href='{{ $service->url }}'">@if($key_service == 0) Get rates @else Compare @endif</button>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="swiper-scrollbar"></div>
            </div>
            @endif
        </section>

        <!-- SECTION NEWS-->
        <section class="guides-section" id="newsSection">
            <div class="container">
                <div class="box-border">
                    @if(!empty($blocks['HOME-NEWS']) && $blocks->get('HOME-NEWS')->first())
                        <h2 class="title big text-center">{!! $blocks['HOME-NEWS'][0]->name !!}</h2>
                    @endif
                </div>
                <div class="slides-gallery">
                    <div class="container">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @if(isset($news) && count($news) > 0)
                                    @foreach($news as $newsItem)
                                        <a class="gallery-item swiper-slide" href="{{ route('frontend.news.detail', ['slug' => $newsItem->slug]) }}">
                                            <div class="img-star img-bg" style="background-image:url({{ asset($newsItem->images) }})">
                                                <img src="{{ asset($newsItem->images) }}" alt="{{ $newsItem->name }}">
                                                
                                                <div class="title">
                                                    <p class="gd-dotdotdot">{{ $newsItem->name }}</p>
                                                </div>
                                                <div class="dark-layer-bottom">
                                                    <div class="info-guides">
                                                        <p class="font-weight-700 guides-dotdotdot ddd-truncated">{{ $newsItem->name }}</p>
                                                        <p class="guides-dotdotdot">{!! $newsItem->description !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="swiper-scrollbar"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION STAR BUY-->
        @if(isset($star_buy_projects) && count($star_buy_projects) > 0)
            <section class="star-buy-section">
                <div class="container">
                    <div class="box-border">
                        @if(!empty($blocks['HOME-STAR-BUY']) && $blocks->get('HOME-STAR-BUY')->first())
                        <h2 class="title big text-center">{!! $blocks['HOME-STAR-BUY'][0]->name !!}</h2>
                        @endif
                    </div>
                    <div class="slides-gallery">
                        <div class="container">
                            <div class="swiper-container">
                                <div class="swiper-wrapper"> 
                                    @foreach($star_buy_projects as $star_buy)                                 
                                        <div class="gallery-item swiper-slide">
                                            <div class="inner-gallery-item">
                                                @if($star_buy->project_slides != null)
                                                    @php 
                                                        $slides = json_decode($star_buy->project_slides); 
                                                    @endphp
                                                @endif
                                                <div class="heart-like" data-project="{{ $star_buy->id }}"></div>
                                                <a class="img-star liked img-bg" href="{{ route('frontend.project.detail', ['slug' => $star_buy->slug]) }}" style="background-image:url({{ (isset($slides[0]) && $slides[0] != null) ? asset($slides[0]) : null }})">
                                                    <img src="{{ (isset($slides[0]) && $slides[0] != null) ? asset($slides[0]) : null }}" alt="{{ (isset($star_buy->name) && $star_buy->name != null) ? $star_buy->name : null }}">
                                                </a>
                                                <div class="description-item">
                                                    <a class="s-title dotdotdot" href="{{ route('frontend.project.detail', ['slug' => $star_buy->slug]) }}">{{ (isset($star_buy->name) && $star_buy->name != null) ? $star_buy->name : null }}</a>
                                                    <a class="s-decs dotdotdot" href="{{ route('frontend.project.detail', ['slug' => $star_buy->slug]) }}">{{ (isset($star_buy->description) && $star_buy->description != null) ? $star_buy->description : null }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper-scrollbar"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- SECTION GUIDES-->
        <section class="guides-section">
            <div class="container">
                <div class="box-border">
                    @if(!empty($blocks['HOME-GUIDES']) && $blocks->get('HOME-GUIDES')->first())
                    <h2 class="title big text-center">{!! $blocks['HOME-GUIDES'][0]->name !!}</h2>
                    @endif
                </div>
                <div class="slides-gallery">
                    <div class="container">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @if(isset($guides) && count($guides) > 0)
                                @foreach($guides as $guide)
                                <a class="gallery-item swiper-slide" href="{{ route('frontend.guides.detail', ['slug' => $guide->slug]) }}">
                                    <div class="img-star img-bg" style="background-image:url({{ asset($guide->images) }})">
                                        <img src="{{ asset($guide->images) }}" alt="{{ $guide->title }}">
                                        
                                        <div class="title">
                                            <p class="gd-dotdotdot">{{ $guide->title }}</p>
                                        </div>
                                        <div class="dark-layer-bottom">
                                            <div class="info-guides">
                                                <p class="font-weight-700 guides-dotdotdot ddd-truncated">{{ $guide->title }}</p>
                                                <p class="guides-dotdotdot">{!! $guide->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="swiper-scrollbar"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION TESTIMONIALS-->
        <section class="testimonials-section">
            <div class="container">
                <div class="box-border">
                    @if(!empty($blocks['HOME-TESTIMONIALS']) && $blocks->get('HOME-TESTIMONIALS')->first())
                    <h2 class="title big text-center">{!! $blocks['HOME-TESTIMONIALS'][0]->name !!}</h2>
                    @endif
                </div>
                <div class="slides-gallery">
                    <div class="container">
                        <div class="swiper-container">                           
                            <div class="swiper-wrapper">
                            @if(isset($testimonials) && count($testimonials) > 0)
                            @foreach($testimonials as $testimonial)                                   
                                <div class="gallery-item swiper-slide">
                                    <div class="inner-item">
                                        <div class="img"><div class="img-bg" style="background-image:url({{ $testimonial->images }})"><img src="{{ $testimonial->images }}" alt="{{ $testimonial->name }}"></div>
                                            <p>{{ $testimonial->name }}</p>
                                        </div>
                                        <div class="info-item">
                                            <p class="scroll-text">{!! $testimonial->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                            </div>
                        </div>
                        <div class="swiper-scrollbar"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION SUBCRIBE-->
        <section class="subcribe-section section-margin-top lazy" @if(!empty($blocks['HOME-SUBRCRIBE']) && $blocks->get('HOME-SUBRCRIBE')->first()) data-src="{!! $blocks['HOME-SUBRCRIBE'][0]->photo !!}" @endif>
            <div class="overlay-greenlight"></div>
            <div class="container text-center">
                <div class="box-border">
                    @if(!empty($blocks['HOME-SUBRCRIBE']) && $blocks->get('HOME-SUBRCRIBE')->first())
                    <h2 class="title big text-white">{!! $blocks['HOME-SUBRCRIBE'][0]->name !!}</h2>
                    @endif
                    <div class="sub-title text-white">{!! $blocks['HOME-SUBRCRIBE'][0]->description !!}</div>
                    <form action="{{ route('subscribe.post') }}" method="post">
                    {!! csrf_field() !!}
                        <div class="form-style form-sub">
                            <div class="form-line bg-yellowish"><span class="input-group-addon">Name <span class="required">*</span></span>
                                <div class="has-input">
                                    <input class="bg-subcribe-input" id="subcribe-name" type="text" name="name" required>
                                     <div id="error-name" class="error invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="form-line bg-yellowish"><span class="input-group-addon">Phone number <span class="required">*</span></span>
                                <div class="has-input">
                                    <input class="bg-subcribe-input" id="subcribe-phone" type="text" minlength="8" pattern="[-+]?[0-9]*[.,]?[0-9]+" name="number" required>
                                    <div id="error-phone" class="error invalid-feedback"></div>
                                </div>
                            </div>
                            
                            <div class="form-line bg-yellowish"><span class="input-group-addon">Email <span class="required">*</span></span>
                                <div class="has-input">
                                    <input class="bg-subcribe-input" id="subcribe-email" type="email" name="email" required>
                                    <div id="error-email" class="error invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="form-line text-center mg-top-20 a-center">
                                <button class="btn-nlp small blue" type="submit" id="submitSubcribe">Send</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@section('footer')
    @include('frontend.layouts.partials.footer')
@endsection

@section('footer-page')
footer-page
@endsection

@section('button-bottom')
<div class="container-fluid footer-btn" id="btn-foot">                       
    <button class="btn-nlp blue" data-toggle="modal" data-target="#modalPopovers">Schedule Showflat Tour</button>
    <button class="btn-nlp green" onclick="window.location.href='https://wa.me/{{ (isset($arr_setting['whatsapp'])) ? $arr_setting['whatsapp'] : '#' }}'">WhatsApp</button>
</div>
@endsection

@push('script')
<script src="{{ asset('assets/js/library_homepage.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    function slideNews()
    {
        new Swiper($('#newsSection .swiper-container'), {
            slidesPerView: 'auto',
            effect: 'slide',
            // spaceBetween: 20,
            freeMode: true,
            navigation: {
                nextEl: '.star-buy-section .swiper-button-next',
                prevEl: '.star-buy-section .swiper-button-prev'
            },
            scrollbar: {
                el: '.star-buy-section .swiper-scrollbar',
                draggable: true
            },
            breakpoints: {
                640: {
                    spaceBetween: 10,
                },
                768: {
                    spaceBetween: 10,
                },
                1024: {
                    spaceBetween: 10,
                },
            }
        }),
    }
    $(document).ready(function(){ 
        slideNews();
        $("#submitSubcribe").click(function(e){
            e.preventDefault();
            $(this).attr("disabled", "disabled");
            $("#error-name").html('');
            $("#error-phone").html('');
            $("#error-email").html('');
            var name = $("#subcribe-name").val();
            var phone = $("#subcribe-phone").val();
            var email = $("#subcribe-email").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type:'POST',
                url: '{{ route('subscribe.post') }}',
                data: {
                    name: name,
                    number: phone,
                    email: email
                },
                dataType: 'json',
                success:function(reponses){
                    $("#subcribe-name").val('');
                    $("#subcribe-phone").val('');
                    $("#subcribe-email").val('');
                    $("#submitSubcribe").removeAttr("disabled");
                    var data = JSON.parse(JSON.stringify(reponses));
                    $("#success-subscribe").text(data.message );
                    swal({
                    title: "Success!",
                    text: data.message,
                    icon: 'success',
                    });
                },
                error:function(reponses) {
                    if( reponses.status === 422 ) {
                        var errors = reponses.responseJSON;
                        $.each(errors.errors, function( key, value ) {
                            if(key == 'name'){
                                $("#error-name").text(value[0]);
                            }
                            else if(key == 'number'){
                                $("#error-phone").text(value[0]);
                            }else{
                                $("#error-email").text(value[0]);
                            }
                        });
                    }else{
                        var data = JSON.parse(JSON.stringify(reponses));
                        swal({
                        title: "Error!",
                        text: 'An error occurred. Please try again later!',
                        icon: 'error',
                        });
                    }
                    $("#submitSubcribe").removeAttr("disabled");
                }
            });
        });
    });
</script>
@endpush
