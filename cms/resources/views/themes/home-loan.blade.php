@extends('frontend.layouts.master')

@push('style')
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')
<main class="wrapper">
    <div class="page-internal-wrapper">
        <!-- HOMELOAN : BANNER-->
       <section class="banner-page-small banner-services">
            <div class="slider-slick">
                @if(isset($banners) && count($banners) > 0)
                @foreach($banners as $banner) 
                <div class="slick-slide">
                    <div class="img-bg page lazy" style="background-image:url({{ (isset($banner) && $banner->image != null) ? asset($banner->image) : null }});"><img src="{{ (isset($banner) && $banner->image != null) ? asset($banner->image) : null }}" alt=""></div>
                    <div class="container text-center">
                        <div class="banner-text title">{{ $banner->title }}</div>
                        <div class="banner-text sub dotdotdot">{{ $banner->description }}</div>
                    </div>
                    <div class="overlay-dark"> </div>
                </div>
                @endforeach
                @endif
            </div>
        </section>
        <div class="container-fluid brand-name">
            <div class="brand-name-group swiper-container">     
                <div class="marquee swiper-wrapper">   

                    @if(isset($partners) && count($partners) > 0)
                        @foreach($partners as $partner)
                            <img src="{{ $partner->image }}" alt="" class="brand-item swiper-slide">
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        <!-- BREADCRUMB-->
        <div class="breadcrumb-page">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" title="Homepage">Homepage</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)" title="Services">Services</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Home loan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- HOMELOAN : CONTENT-->
        <!-- Lastest SIBOR/SOR Rates-->
        <section class="section-margin-services sibor-section">
            <div class="container">   
                <div class="box-border">
                    @if(!empty($blocks['HOME-LOAN-SIBOR-SOR']) && $blocks->get('HOME-LOAN-SIBOR-SOR')->first())
                    <h2 class="title big text-center">
                      <span><span>{!! $blocks['HOME-LOAN-SIBOR-SOR'][0]->name !!}</span></span>
                    </h2>
                    @endif
                </div>
                <div class="row table-nlp">
                    @if(isset($sibor_rates) && $sibor_rates != null)
                    @php
                        $month_sibors = json_decode($sibor_rates->month_sibor);
                        $percent_sibors = json_decode($sibor_rates->percent_sibor);
                    @endphp
                    <div class="col-lg-6">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2"> 
                                        <p class="title-tb">This month’s SIBOR rates</p>
                                        <p class="time-tb"> Last Updated {{ $sibor_rates->date }}</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($month_sibors != null && $percent_sibors != null)
                                @foreach($month_sibors as $key => $month_sibor)
                                <tr>
                                    <td>
                                        <p class="dot">{{ $month_sibor }}</p>
                                    </td>
                                    <td class="df-end"> {{ (isset($percent_sibors[$key])) ? $percent_sibors[$key] : null }}%</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if(isset($sor_rates) && $sor_rates != null)
                    @php
                        $month_sors = json_decode($sor_rates->month_sibor);
                        $percent_sors = json_decode($sor_rates->percent_sibor);
                    @endphp
                    <div class="col-lg-6">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2"> 
                                        <p class="title-tb">This month’s SOR rates</p>
                                        <p class="time-tb"> Last Updated {{ $sor_rates->date }}</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($month_sors != null && $percent_sors != null)
                                @foreach($month_sors as $key => $month_sor)
                                <tr>
                                    <td>
                                        <p class="dot">{{ $month_sor }}</p>
                                    </td>
                                    <td class="df-end"> {{ (isset($percent_sors[$key])) ? $percent_sors[$key] : null }}%</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <!--3 Easy Steps-->
        <section class="services-section section-margin-services step-section services-section-page">
            <div class="container">
                <div class="box-border p-top-45">
                    @if(!empty($blocks['EASY-STEP']) && $block = $blocks->get('EASY-STEP')->first())
                    <h2 class="title big text-center"><span><span>{!! $block->name !!} </span></span></h2>
                    @endif
                </div>
            </div>
            @if(isset($block->children))
            <div class="services-content container">
                <div class="row swiper-container">
                    <div class="swiper-wrapper">
                        @php $i = 1 @endphp
                        @foreach($block->children as $key => $item)
                        @if($key == 0)
                            @php $icon = 'icon-task-note' @endphp
                        @elseif($key == 1)
                            @php $icon = 'icon-hand-dot' @endphp
                        @else
                            @php $icon = 'icon-goals' @endphp
                        @endif
                        <div class="col-lg-4 inner-services-page swiper-slide">
                            <div class="inner-item">
                                <i class="icon {{ $icon }}"></i>
                                <p class="s-title font-weight-regular">Step <span>{{ $i }}</span></p>
                                <p class="s-desc scroll-text">{{ $item->description }}</p>
                            </div>
                        </div>
                        @php $i++ @endphp
                        @endforeach
                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
            @endif
        </section>
        <!-- Why New Launch Portal-->
        <section class="services-section section-margin why-nlp-section services-section-page">
            <div class="container">
                <div class="box-border">
                    @if(!empty($blocks['WHY-NEW-LAUNCH']) && $block_why = $blocks->get('WHY-NEW-LAUNCH')->first())
                    <h2 class="title big text-center"><span><span>{!! $block_why->name !!}</span></span></h2>
                    @endif
                </div>
            </div>
            <div class="services-section container">
                @if(isset($block_why->children))
                    <div class="row swiper-container">
                        <div class="swiper-wrapper">
                            @php $i = 1 @endphp
                            @foreach($block_why->children as $key => $item_why)
                            @if($key == 0)
                                @php $icon = 'icon-award' @endphp
                            @elseif($key == 1)
                                @php $icon = 'icon-star' @endphp
                            @else
                                @php $icon = 'icon-globe' @endphp
                            @endif
                            <div class="col-lg-4 inner-services-page swiper-slide">
                                <div class="inner-item">
                                    <i class="icon {{ $icon }}"></i>
                                    <p class="s-desc scroll-text">{{ $item_why->description }}</p>
                                </div>
                            </div>
                            @php $i++ @endphp
                            @endforeach
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                @endif       
            </div>
        </section>
        <!--Testimonials-->
        <section class="testimonials-section section-margin s-testimonials">
            <div class="container">
                <div class="box-border p-top-45">
                    @if(!empty($blocks['HOME-LOAN-TESTIMONIALS']) && $blocks->get('HOME-LOAN-TESTIMONIALS')->first())
                    <h2 class="title big text-center"><span><span>{!! $blocks['HOME-LOAN-TESTIMONIALS'][0]->name !!}</span></span></h2>
                    @endif
                </div>
                <div class="slides-gallery">
                    <div class="container">
                        <div class="row swiper-container"> 
                            <div class="swiper-wrapper">
                                @if(isset($testimonials) && count($testimonials) > 0)
                                @foreach($testimonials as $testimonial)
                                <div class="gallery-item swiper-slide col-lg-4">
                                    <div class="inner-item">
                                        <div class="img"><img src="{{ $testimonial->images }}" alt="{{ $testimonial->name }}">
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
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Contact Us-->
        <section class="contact-page-section s-contact">
            <div class="container">
                <div class="contact-content">
                    <div class="box-border">
                        @if(!empty($blocks['HOME-LOAN-CONTACT']) && $blocks->get('HOME-LOAN-CONTACT')->first())
                        <h2 class="title big text-center"><span><span>{!! $blocks['HOME-LOAN-CONTACT'][0]->name !!}</span></span></h2>
                        @endif
                    </div>
                    <div class="box-border">              
                        <div class="form-style form-sub">
                            <form class="form-validate" action="{{ route('contact.post') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="form-line"><span class="input-group-addon">Name </span>
                                    <div class="has-input">
                                        <input id="name" type="text" name="name" placeholder="Enter your name" required>
                                    </div>
                                </div>
                                <div class="form-line"><span class="input-group-addon">Phone number </span>
                                    <div class="has-input">
                                        <input id="phone" type="text" name="phone" placeholder="Enter your phone number" minlength="8" pattern="[-+]?[0-9]*[.,]?[0-9]+" required>
                                    </div>
                                </div>
                                <div class="form-line"><span class="input-group-addon">Email</span>
                                    <div class="has-input">
                                        <input id="email" type="email" name="email" placeholder="Enter your email">
                                    </div>
                                </div>
                                <div class="form-line"><span class="input-group-addon">Enquiry type</span>
                                    <div class="check-group">
                                        <label class="has-checkbox">
                                            <input id="own" type="checkbox" name="type[]" value="1" checked><span>Home loan</span>
                                        </label>
                                        <label class="has-checkbox">
                                            <input id="inves" type="checkbox" name="type[]" value="2" checked><span>Mortgage Insurance</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-line"><span class="input-group-addon">Message</span>
                                    <div class="has-input">
                                        <textarea id="msg-contact" rows="4" name="message" placeholder="Enter your message"></textarea>
                                    </div>
                                </div>
                                
                                @if(\Session::has('success-contact'))
                                <div id="success-subscribe">{!! \Session::get('success-contact') !!}</div>
                                @endif

                                <div class="form-line no-margin text-center a-center">
                                    <button class="btn-nlp small blue" type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
<div class="container-fluid footer-btn hide-element-on-keyboard" id="btn-foot">                       
    <button class="btn-nlp green" onclick="window.location.href='https://wa.me/{{ (isset($arr_setting['whatsapp'])) ? $arr_setting['whatsapp'] : '#' }}'">WhatsApp</button>
</div>
@endsection

@push('script')
<script src="{{ url('assets/js/library.js') }}"></script>
<script async src="{{ url('assets/js/pages.js') }}"></script>
@endpush
