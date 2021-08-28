@extends('frontend.layouts.master')

@push('style')
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')
<main class="wrapper">
    <div class="page-internal-wrapper">
        <!-- MORTGAGE INSURANCE : BANNER-->
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
                        <li class="breadcrumb-item active" aria-current="page">Mortgage Insurance</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- MORTGAGE INSURANCE  : CONTENT    -->
        <section class="section-margin-services rated-section mortgage-section">
            <div class="container">

            	@if(!empty($blocks['WHAT-MORTGAGE']) && $block_what = $blocks->get('WHAT-MORTGAGE')->first())   
                <div class="box-border">
                    <h2 class="title big text-center">
                      <span><span>{!! $blocks['WHAT-MORTGAGE'][0]->name !!}</span></span>
                    </h2> 
                </div>
                @if(isset($block_what->content))
                <div class="box-border content-box">
                    {!! $block_what->content !!}
                </div>
                @endif
            	
        		@if(isset($block_what->children))
                <div class="box-border content-box">
                    <div class="row gallery-img">
                    	@foreach($block_what->children as $item_what)
                        <div class="col-lg-3 col-md-6 inner-gallery">
                            <div class="img-item">
                                <div class="img-bg lazy" data-src="{{ asset($item_what->photo) }}">
                                    <img src="{{ asset($item_what->photo) }}" alt="{!! $item_what->name !!}">
                                </div>
                            </div>
                            <div class="caption">{!! $item_what->name !!}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @endif
            </div>
        </section>
        <!--  Rates-->
        <section class="section-margin-services rated-section" style="background:#EBEBEB">
            <div class="container">   
                <div class="box-border p-top-45">
                	@if(!empty($blocks['MORTGAGE-RATES']) && $block = $blocks->get('MORTGAGE-RATES')->first()) 
                    <h2 class="title big text-center"><span><span>{!! $block->name !!}</span></span></h2>
                    @endif
                </div>

                @if(isset($mortgages) && count($mortgages) > 0)
                <div class="table-nlp">
                    <div class="box-border">
                        <table class="table table-striped table-hover table-responsive" id="rates-table">
                            <thead>
                                <tr>
                                    <th>
                                        <p class="title-tb">Issurer</p>
                                    </th>
                                    <th>
                                        <p class="title-tb">Benefits</p>
                                    </th>
                                    <th>
                                        <p class="title-tb">Premium</p>
                                    </th>
                                    <th>
                                        <p>&nbsp;   </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($mortgages as $mortgage)
                                <tr>
                                    <td class="text-center"> 
                                        <div class="img-logo-desktop horizontal">
                                            <div class="img-bg" style="background-image:url({{ asset($mortgage->images) }})"><img src="{{ asset($mortgage->images) }}" alt="{{ $mortgage->issurer }}"></div>
                                        </div>
                                    </td>
                                    <td class="w50p">{!! str_replace("\r\n","<br/>",$mortgage->benefits) !!}</td>
                                    <td> {{ number_format($mortgage->premium,0,',','.') }} SGD/Year</td>
                                    <td><a class="btn-nlp small blue long" href="{{ getPageUrlByCode('CONTACT') }}?issurer={{ $mortgage->issurer }}">Contact us</a></td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <!--slide on mobile-->
                <div class="rates-mobile">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                            @if(isset($mortgages) && $mortgages != null) 
                                @foreach($mortgages as $mortgage)
                                <div class="rates-item swiper-slide">
                                    <div class="block">
                                        <div class="img-logo horizontal"> 
                                            <div class="img-bg" style="background-image:url({{ asset($mortgage->images) }})"><img src="{{ asset($mortgage->images) }}" alt="{{ $mortgage->issurer }}"></div>
                                        </div>
                                        <div class="info scroll-text">{!! str_replace("\r\n","<br/>",$mortgage->benefits) !!}</div>
                                        <div class="purchase">{{ number_format($mortgage->premium,0,',','.') }} USD/Year</div><a class="btn-nlp small blue" href="{{ getPageUrlByCode('CONTACT') }}">Contact us</a>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </div>
        </section>
        <!--  Contact  -->
        <section class="contact-page-section s-contact">
            <div class="container">
                <div class="contact-content mg-bot-50">
                    <div class="box-border">
                        @if(!empty($blocks['MORTGAGE-CONTACT']) && $blocks->get('MORTGAGE-CONTACT')->first())
                        <h2 class="title big text-center"><span><span>{!! $blocks['MORTGAGE-CONTACT'][0]->name !!}</span></span></h2>
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
                                            <input id="own2" type="checkbox" name="type[]" value="1" checked><span>Home loan</span>
                                        </label>
                                        <label class="has-checkbox">
                                            <input id="inves2" type="checkbox" name="type[]" value="2" checked><span>Mortgage Insurance</span>
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
