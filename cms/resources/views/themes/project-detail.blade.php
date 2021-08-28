@extends('frontend.project.master')

@push('style')
<link href="{{ asset('assets/css/styles_project2.css') }}" rel="stylesheet">
@endpush

@section('logo-project'){{ isset($project->project_logo) ? $project->project_logo : NULL }}@endsection

@section('content')

<!-- Section detail-->
<section class="section-full pdetail-s-intro" data-anchor="intro">
    <div class="img-bg lazy" @if(isset($project->project_background_section)) data-src="{{ url($project->project_background_section) }}" @endif></div>
    <div class="content-right">
        <div class="wrapper-text">
            <h1 class="name-project">{{ isset($project->name) ? $project->name : NULL }}</h1>
            <div class="state-proj">Lasted update</div>

            @if(isset($project_last_update) && count($project_last_update) > 0)
            <table class="table-lasted">
                @foreach($project_last_update as $last_update)
                <tr>
                    <td class="date">{{ (isset($last_update->date) && $last_update->date != null) ? $last_update->date : null }}</td>
                    <td>{!! (isset($last_update->content) && $last_update->content != null) ? $last_update->content : null !!}</td>
                </tr>
                @endforeach
            </table>
            @endif

            <div class="timeline">
                <div class="unit-sold">Units Sold in Feburary</div>
                <div class="td">
                    <marquee onmouseover="this.stop();" onmouseout="this.start();">{{ $project->project_more_url }}</marquee>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section project info-->

<section class="section-full pdetail-s-feature" data-anchor="feature">
    <div class="project-info swiper-container">
        <div class="swiper-wrapper">
            @if($project->project_text_grid != null)
                @php 
                    $text_grids = json_decode($project->project_text_grid);
                @endphp
            @endif
            @if($project->project_grid != null)
            @php 
                $grids = json_decode($project->project_grid); 
            @endphp
                @if(count($grids))
                @foreach($grids as $key_grid => $grid)
                <div class="info swiper-slide">
                    <div class="img-item">
                        <div class="img-bg" style="background-image: url({{ $grid }})"><img src="{{ $grid }}" alt=""></div>
                        <div class="dark-layer-center">                               
                            <div class="desc">{{ (isset($text_grids->project_title[$key_grid])) ? $text_grids->project_title[$key_grid] : null }}</div>
                            <div class="title">{{ (isset($text_grids->project_subtitle[$key_grid])) ? $text_grids->project_subtitle[$key_grid] : null }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            @endif
        </div>
    </div>
</section>
<!-- Section location-->

<section class="section-full pdetail-s-location pdetail-spacing" data-anchor="location">
    <div class="wrap-info">
        <div class="pdetail-info">
            @if(isset($project->location_title))
            <h2 class="pdetail-title">{!! $project->location_title !!}</h2>
            @endif
            @if(isset($project->location_subtitle))
            <div class="tick">{!! $project->location_subtitle !!}</div>
            @endif
        </div>
        @if(isset($project->location_description))
            <div class="sub">{!! $project->location_description !!}</div>
            @endif
    </div>
    <div class="map-site">
        @php 
        $polygon = json_decode($project->map_shape);
         @endphp
        <div class="google-map-pdetail" id="google-map-div" data-json='{"location": {"lat":{{ isset($project->lat) ? $project->lat : '53.431976' }}, "lng":{{ isset($project->lng) ? $project->lng : '-2.9617522' }}}, "stations": {"icon_url": "/images/googlemap/icon-station.svg"}, "schools": {"icon_url": "/images/googlemap/icon-school.svg"}, "area": {{ isset($polygon->area) ? json_encode($polygon->area) : '[{&quot;lat&quot;:1.363702693942045,&quot;lng&quot;:103.83471292035438},{&quot;lat&quot;:1.3627588235945527,&quot;lng&quot;:103.8326100684867},{&quot;lat&quot;:1.3603991461080711,&quot;lng&quot;:103.83213799970008},{&quot;lat&quot;:1.3588546286851957,&quot;lng&quot;:103.83110803143836},{&quot;lat&quot;:1.3589833385081684,&quot;lng&quot;:103.82930558698035},{&quot;lat&quot;:1.3576962399698265,&quot;lng&quot;:103.82921975629188},{&quot;lat&quot;:1.3541781671372186,&quot;lng&quot;:103.83355420605994},{&quot;lat&quot;:1.3531055829401715,&quot;lng&quot;:103.83569997327186},{&quot;lat&quot;:1.3610426947425178,&quot;lng&quot;:103.84089272992469}]' }} }'></div>
        <div class="open-map-info"></div>
        <div class="map-info">
            <ul class="nav tabs-desc nav-tabs">
                <li class="isTravelDir">                       <a class="tab-title" href="#dir" role="tab" data-toggle="tab"> <i class="icon icon-marker-disable"></i>
                        <p>Travel Directions</p></a></li>
                <li>                           <a class="tab-title active" href="#trans" role="tab" data-toggle="tab"> <i class="icon icon-train-disable"></i>
                        <p>MRT Stations</p></a></li>
                <li><a class="tab-title" href="#scho" role="tab" data-toggle="tab"> <i class="icon icon-book-disable"></i>
                        <p>Nearby Schools</p></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="dir" role="tabpanel">
                    <div class="search-map-layer">
                        <p>Enter a location to view travel directions</p>
                        <div class="filter-form">
                            <form action="#">
                                <div class="position">
                                    <input type="text" placeholder="Enter starting point..." data-json='{"location": {"lat":{{ isset($project->lat) ? $project->lat : '53.431976' }}, "lng":{{ isset($project->lng) ? $project->lng : '-2.9617522' }}}}' id="positionA" value="{{ isset($project->location) ? $project->location : null }}">
                                </div>
                                <div class="position">
                                    <input type="text" placeholder="Enter destination..." required id="positionB">
                                </div>
                                <div class="search">
                                    <button class="btn-search black" type="submit"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="result">
                        <div class="pane-direction pane-content scroll-ui">
                            <div id="dir-contain">
                                <h4 class="pt-3 pb-2 text-center">Travel Directions</h4><a class="group-direction d-none" href="#">
                                    <div class="info">                                   <span class="font-weight-700">Lorem ipsum</span><span>700m</span></div>
                                    <div class="tip"><span>Lorem ipsum dolor sit amet, consetetur</span><span>2h                                </span></div></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane active" id="trans" role="tabpanel">
                    <div class="pane-layer">Nearby MRT Stations</div>
                    <div class="result">
                        <div class="pane-direction pane-content scroll-ui">
                            <div id="trans-contain">
                                <h4 class="pt-3 pb-2 text-center">MRT Stations</h4>
                                <div class="group-direction d-none">
                                    <div class="info">                                   <a class="btn-nlp small red" href="javascript:void(0)">N 545</a>
                                        <p>Somerset MRT station</p>
                                    </div>
                                    <div class="tip">130m                                                 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="scho" role="tabpanel">
                    <div class="pane-layer">Nearby Schools</div>
                    <div class="result">
                        <div class="pane-direction pane-content scroll-ui">
                            <div id="scho-contain">
                                <h4 class="pt-3 pb-2 text-center">Nearby Schools</h4>
                                <div class="group-direction d-none">
                                    <div class="info">                                   <a class="btn-nlp small red" href="javascript:void(0)">N 644</a>
                                        <p>Somerset High school</p>
                                    </div>
                                    <div class="tip">70m        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Section Gallery-->
@include('themes.partials.gallery')
<!-- End Section Gallery-->

<!-- Section Pricing-->
<section class="section-full pdetail-s-pricing pdetail-spacing" data-anchor="pricing">
    <div class="wrap-info">
        <div class="pdetail-info">
            @if(isset($project->project_price_title))
            <h2 class="pdetail-title">{!! $project->project_price_title !!}</h2>
            @endif
            @if(isset($project->project_price_subtitle))
            <div class="tick">{!! $project->project_price_subtitle !!}</div>
            @endif
        </div>
        @if(isset($project->project_price_description))
            <div class="sub no-margin">{!! $project->project_price_description !!}</div>
        @endif
    </div>
    <div class="content-section">
        <div class="wrap-slider">
            <div class="owl-carousel">
                @if($project->project_price_table != null)
                    @php 
                        $price_tables = json_decode($project->project_price_table);
                    @endphp
                @endif
                @if($project->project_price_images != null)
                    @php 
                        $price_images = json_decode($project->project_price_images);
                    @endphp
                @endif
                @if($project->project_price_name_detail != null)
                @php 
                    $name_prices = json_decode($project->project_price_name_detail); 
                @endphp

                    @if(count($name_prices) && count($price_tables))
                        @foreach($name_prices as $key_prices => $name_price)
                        <a class="inner-item" href="javascript:void(0)">
                            <div class="img">
                                <div class="img-bg" style="background-image:url('{{ isset($price_images[$key_prices]) ? asset($price_images[$key_prices]) : null }}')">
                                    <img src="{{ isset($price_images[$key_prices]) ? asset($price_images[$key_prices]) : null }}" alt="">
                                </div>
                            </div>
                            <h5 class="title">{{ $name_price }}</h5>
                            <div class="tag-price">From <span>{{ isset($price_tables[$key_prices]) ? $price_tables[$key_prices] : null }}</span>
                            </div>
                        </a>
                        @endforeach
                    @endif
                @endif
            </div>
            <div class="text-center">
                <button class="btn-nlp small blue" data-toggle="modal" data-target="#modalProject-detail-contact">Contact</button>
            </div>
        </div>
    </div>
</section>
<section class="section-full pdetail-s-floorplan pdetail-spacing" data-anchor="floorplan">
    <div class="wrap-info">
        <div class="pdetail-info">
            @if(isset($project->floorplan_title))
            <h2 class="pdetail-title">{!! $project->floorplan_title !!}</h2>
            @endif
            @if(isset($project->floorplan_subtitle))
            <div class="tick">{!! $project->floorplan_subtitle !!}</div>
            @endif
        </div>
        @if(isset($project->floorplan_description))
            <div class="sub">{!! $project->floorplan_description !!}</div>
        @endif
    </div>
    <div class="content-section">
        <div class="inner-info">
            @if(isset($arr_floor_types) && count($arr_floor_types) > 0)
                <!-- for desktop-->
                <div class="drop-desktop">
                    <div class="sidebar-filter scroll-ui">
                        <ul class="nav-filter">
                            
                            @if(isset($floor_categories) && $floor_categories != null)
                                @php $i = $j = 0; @endphp

                                @foreach($floor_categories as $floor_category)
                                <li><a class="collapsible square" href="#collapse-submenu-{{ $i }}" @if($i == 0 && $j == 0) aria-expanded="true" @endif data-toggle="collapse">{{ $floor_category->name }}<span></span></a>

                                    @if(isset($arr_floor_types[$floor_category->id]))
                                    <ul class="content collapse" id="collapse-submenu-{{ $i }}">

                                        @foreach($arr_floor_types[$floor_category->id] as $parent_types => $arr_types)
                                        <li>
                                            <a @if($arr_types == null) class="open-info" data-open="open-{{ isset($floor_category->id) ? $floor_category->id : null }}-{{ isset($floor_types[$parent_types]->id) ? $floor_types[$parent_types]->id : null }}" @else class="collapsible square"  @if($i == 0 && $j == 0) aria-expanded="true" @endif href="#collapse-submenu-{{ $i }}-{{ $j }}" data-toggle="collapse" @endif>{{ isset($floor_types[$parent_types]) ? $floor_types[$parent_types]->name : null }} @if($arr_types != null) <span></span> @endif
                                            </a>
                                            @if($arr_types != null)
                                                <ul class="content collapse" id="collapse-submenu-{{ $i }}-{{ $j }}">
                                                    @foreach($arr_types as $arr_child)
                                                        <li><a class="open-info" data-open="open-{{ isset($floor_category->id) ? $floor_category->id : null }}-{{ isset($floor_types[$parent_types]->id) ? $floor_types[$parent_types]->id : null }}-{{ isset($floor_types[$arr_child]->id) ? $floor_types[$arr_child]->id : null }}">{{ isset($floor_types[$arr_child]->name) ? $floor_types[$arr_child]->name : null }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                        @php $j++; @endphp
                                        @endforeach

                                    </ul>
                                    @endif

                                </li>
                                @php $i++; $j++; @endphp
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
                <!-- For mobile-->
                <div class="drop-mobile">
                    <div class="sidebar-filter">
                        <select id="select-floor-plan" data-placeholder="Name" tabindex="1">
                            <option value="">Please select</option>

                            @if(isset($floor_categories) && $floor_categories != null)
                            @php $i = $j = 0; @endphp

                            @foreach($floor_categories as $floor_category)
                            <optgroup label="{{ $floor_category->name }}">

                                @if(isset($arr_floor_types[$floor_category->id]))

                                    @foreach($arr_floor_types[$floor_category->id] as $parent_types => $arr_types)
                                    <option value="@if($arr_types == null){{ isset($floor_category->id) ? $floor_category->id : null }}-{{ isset($floor_types[$parent_types]->id) ? $floor_types[$parent_types]->id : null }}@endif" @if($arr_types != null) disabled @endif> {{ isset($floor_types[$parent_types]) ? $floor_types[$parent_types]->name : null }}

                                        @if($arr_types != null)
                                            @foreach($arr_types as $arr_child)
                                                <option value="{{ isset($floor_category->id) ? $floor_category->id : null }}-{{ isset($floor_types[$parent_types]->id) ? $floor_types[$parent_types]->id : null }}-{{ isset($floor_types[$arr_child]->id) ? $floor_types[$arr_child]->id : null }}">&nbsp;&nbsp;&nbsp; {{ isset($floor_types[$arr_child]->name) ? $floor_types[$arr_child]->name : null }}</option>
                                            @endforeach
                                        @endif

                                    </option>
                                    @php $j++; @endphp
                                    @endforeach

                                @endif

                            </optgroup>
                            @php $i++; $j++; @endphp
                            @endforeach

                            @endif

                        </select>
                    </div>
                </div>
                
                <!-- Call function get data -->
                <div class="content-right">
                    <div class="logo-brand">
                        <a class="img-bg 
                            @if(isset($project->option) && $project->option == 1) 
                                vertical 
                            @else 
                                horizontal 
                            @endif" 
                            href="#intro" 
                            style="background-image:url('{{ $project->project_logo }}')">
                            <img src="{{ $project->project_logo }}" alt="">
                        </a>
                    </div>
                    <div class="inner-content-right">
                        <!-- show PDF -->
                        {{-- <div class="intro-file had-pdf">
                            <a class="linkFile" href="#modalFilePdf" data-toggle="modal" data-pdf="">
                                <img src="/images/bg-pdf.jpg" alt="">
                            </a>
                        </div> --}}
                        <!-- end show PDF -->

                        <!-- show info & image -->
                        <div class="row">
                            <div class="col-lg-5 info-plan">
                                <div class="type-item">
                                    <div class="type-name"></div>
                                    <div class="sub-type"></div>
                                    <div class="desc-type"></div>
                                    <div class="unit">
                                        <span class="font-weight-700 unit-title"></span>
                                        <div class="unit-content"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 intro-plan">
                                <div class="img-desc not-had-pdf">
                                    <div class="item-img">
                                        <a class="img-bg">
                                            <img src="" data-img="" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="intro-file had-pdf">
                                    <a class="linkFile" href="#modalFilePdf" data-toggle="modal" data-pdf="">
                                        <img src="/images/bg-pdf.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end show info & image -->
                    </div>
                </div>
                <!-- End Call function get data -->
            @endif
        </div>
    </div>
</section>
<!--Section Contact-->
<section class="section-full pdetail-s-contact pdetail-spacing" data-anchor="contact">
    <div class="wrap-info">
        <div class="pdetail-info">
            @if(isset($project->contact_title))
            <h2 class="pdetail-title">{!! $project->contact_title !!}</h2>
            @endif
            @if(isset($project->contact_subtitle))
            <div class="tick">{!! $project->contact_subtitle !!}</div>
            @endif
        </div>
        @if(isset($project->contact_description))
            <div class="sub">{!! $project->contact_description !!}</div>
        @endif
    </div>
    <div class="contact-content">
        <div class="wrap-align">
            <div class="box-border">
                <div class="info-contact">
                    <div class="item-contact"><i class="icon icon-mail-big"></i><span class="font-weight-700">{{ isset($project->email) ? $project->email : 'enquiry@newlaunchportal.com.sg' }}</span></div>
                    <div class="item-contact"><i class="icon icon-call-big"></i><span class="font-weight-700">{{ isset($project->phone) ? $project->phone : '+65 6100 9876' }}</span></div>
                </div>
            </div>
            <div class="box-border">              
                <div class="form-style form-sub form-product-v2-js">
                    <form class="form-validate-contact" action="{{ route('contact.post') }}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="type[]" value="3"><span></span>
                    <input type="hidden" name="project_id" value="{{ $project->id }}"><span></span>
                    <div class="form-line"><span class="input-group-addon">Name <span class="required">*</span></span>
                        <div class="has-input">
                            <input id="name_pdContact" type="text" placeholder="Enter your name" name="name">
                        </div>
                    </div>
                    <div class="form-line"><span class="input-group-addon">Email <span class="required">*</span></span>
                        <div class="has-input">
                            <input id="mail_pdContact" type="email" placeholder="Enter your email" name="email">
                        </div>
                    </div>
                    <div class="form-line"><span class="input-group-addon">Phone number <span class="required">*</span></span>
                        <div class="has-input">
                            <input id="phone_pdContact" type="text" placeholder="Enter your phone number" name="phone">
                        </div>
                    </div>
                    <div class="form-line"><span class="input-group-addon">Message</span>
                        <textarea id="msg_pdContact" rows="4" placeholder="Enter your message" name="message"></textarea>
                    </div>
                    <div class="form-line no-margin text-center">
                        <button class="btn-nlp small blue long" type="submit">Send Message</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal-project')
<!--MODAL SCHEDULE-->
<div class="modal fade project-detail-modal" id="modalProject-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content row">
            <div class="col-lg-6 content-left project-detail-content-modal-left" style="background-image: url({{ asset($project->project_background_section) }})">                  
                <button class="close btn-close-modal-mobile" type="button" data-dismiss="modal" aria-label="Close"></button>
                <div class="layer-intro">
                    <div class="container text-center">
                        <div class="img-bg @if(isset($project->option) && $project->option == 1) vertical @else horizontal @endif" style="background-image:url({{ asset($project->project_logo) }})"><img src="{{ asset($project->project_logo) }}" alt=""></div>
                        
                        <p>Sales Hotline: {{ $project->phone }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 content-right project-detail-content-modal-right">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Schedule Showflat Tour</h5>
                    <button class="close btn-close-modal" type="button" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="schedule-tour">
                    <ul class="nav tabs-desc"> 
                        <li class="active"><a class="tab-title active show" href="#sche" role="tab" data-toggle="tab">Schedule Tour</a></li>
                        <li><a class="tab-title" href="#regis" role="tab" data-toggle="tab">VVIP Registration</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="sche" role="tabpanel">
                            <div class="box-border">              
                                <div class="form-style form-sub">
                                    <div class="form-subs">
                                        <p>{{ (isset($arr_setting['description_schedule_showflat'])) ? $arr_setting['description_schedule_showflat'] : NULL }}</p>
                                    </div>
                                    <form class="form-validate scheduleForm" action="{{ route('schedule.showflat.post') }}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" class="project_choose" name="project_id" value="{{ $project->id }}">
                                        <div class="form-line"><span class="input-group-addon">Name <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input id="name" type="text" required name="fullname">
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Phone number <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input id="phone" type="text" minlength="8" pattern="[-+]?[0-9]*[.,]?[0-9]+" required name="phone">
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Date <span class="required">*</span></span>
                                            <div class="day-stream">
                                                <div class="dayline-carousel">
                                                    <div class="slick-carousel">
                                                        @php $current_day = \Carbon\Carbon::now(); @endphp
                                                        @for($i = 1; $i <= 14; $i++)
                                                        @php
                                                            $next_day = $current_day->addDay();
                                                            $date_of_next = $next_day->format("d M y");
                                                            $day_of_week = $next_day->format("D");
                                                        @endphp
                                                        <label class="gallery-item date-item" data-date="{{ $date_of_next }}">    
                                                            <div class="block">
                                                                <input type="radio" name="date" value="{{ date("Y-m-d", strtotime($date_of_next)) }}" required><span>{{ $date_of_next }}</span>
                                                                <p class="font-weight-700">{{ $day_of_week }}</p>
                                                            </div>
                                                        </label>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="date" id="pick-date">
                                        <div class="form-line" id="timepicker"><span class="input-group-addon">Time <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input class="timepicker" id="time" type="text" required name="time">
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Message <span class="required">*</span></span>
                                            <div class="has-input">
                                                <textarea id="msg" rows="4" name="message">{!! isset($arr_setting['message_schedule_tour']) ? $arr_setting['message_schedule_tour'] : NULL !!}</textarea>
                                            </div>
                                        </div>
                                        <label class="has-checkbox">
                                            <input id="agree" type="checkbox" name="agree" checked><span>Please arrange for transportation to showflat</span>
                                        </label>
                                        <div class="form-line no-margin text-center a-center">
                                            <button class="btn-nlp small blue" type="submit">Submit                           </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="regis" role="tabpanel">
                            <div class="box-border">              
                                <div class="form-style form-sub">
                                    <form class="form-validate" action="{{ route('schedule.showflat.post') }}" method="post">
                                        <div class="form-subs">
                                            <p>{{ (isset($arr_setting['description_vipp_showflat'])) ? $arr_setting['description_vipp_showflat'] : NULL }}</p>
                                        </div>
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="1">
                                        <input type="hidden" class="project_choose" name="project_id" value="{{ $project->id }}">
                                        <input type="hidden" class="project_choose" name="typeVip" value="1">
                                        <div class="form-line"><span class="input-group-addon">Name <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input id="name" type="text" required name="fullname">
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Phone number <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input id="phone" type="text" minlength="8" pattern="[-+]?[0-9]*[.,]?[0-9]+" required name="phone">
                                            </div>
                                        </div>
                                        <div class="form-line no-margin text-center a-center">
                                            <button class="btn-nlp small blue" type="submit">Submit </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL BUTTON CONTACT-->
<div class="modal fade project-detail-modal" id="modalProject-detail-contact" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content row">
            <div class="col-lg-6 content-left project-detail-content-modal-left" style="background-image: url({{ asset($project->project_background_section) }})">                  
                <button class="close btn-close-modal-mobile" type="button" data-dismiss="modal" aria-label="Close"></button>
                <div class="layer-intro">
                    <div class="container text-center">
                        <div class="img-bg @if(isset($project->option) && $project->option == 1) vertical @else horizontal @endif" style="background-image:url({{ asset($project->project_logo) }})"><img src="{{ asset($project->project_logo) }}" alt=""></div>
                        <p>Sales Hotline: {{ (isset($project->phone)) ? $project->phone : null }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 content-right project-detail-content-modal-right">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Schedule Showflat Tour</h5>
                    <button class="close btn-close-modal" type="button" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="schedule-tour">
                    <ul class="nav tabs-desc"> 
                        <li><a class="tab-title" href="#sche1" role="tab" data-toggle="tab">Schedule Tour</a></li>
                        <li class="active"><a class="tab-title active show" href="#regis1" role="tab" data-toggle="tab">VVIP Registration</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="sche1" role="tabpanel">
                            <div class="box-border">              
                                <div class="form-style form-sub">
                                    <form class="form-validate scheduleForm" action="{{ route('schedule.showflat.post') }}" method="post">
                                    {!! csrf_field() !!}
                                    <div class="form-subs">
                                        <p>{{ (isset($arr_setting['description_schedule_showflat'])) ? $arr_setting['description_schedule_showflat'] : NULL }}</p>
                                    </div>
                                    <input type="hidden" class="project_choose" name="project_id" value="{{ $project->id }}">
                                        <div class="form-line"><span class="input-group-addon">Name <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input id="name" type="text" required name="fullname">
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Phone number <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input id="phone" type="text" minlength="8" pattern="[-+]?[0-9]*[.,]?[0-9]+" required name="phone">
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Date <span class="required">*</span></span>
                                            <div class="day-stream">
                                                <div class="dayline-carousel">
                                                    <div class="slick-carousel">
                                                        @php $current_day = \Carbon\Carbon::now(); @endphp
                                                        @for($i = 1; $i <= 14; $i++)
                                                        @php
                                                            $next_day = $current_day->addDay();
                                                            $date_of_next = $next_day->format("d M y");
                                                            $day_of_week = $next_day->format("D");
                                                        @endphp
                                                        <label class="gallery-item date-item" data-date="{{ $date_of_next }}">
                                                            <div class="block">    
                                                                <input type="radio" name="date" value="{{ date("Y-m-d", strtotime($date_of_next)) }}" required><span>{{ $date_of_next }}</span>
                                                                <p class="font-weight-700">{{ $day_of_week }}</p>
                                                            </div>
                                                        </label>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="date" id="pick-date1">
                                        <div class="form-line" id="timepicker"><span class="input-group-addon">Time <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input class="timepicker" id="time" type="text" required name="time">
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Message <span class="required">*</span></span>
                                            <div class="has-input">
                                                <textarea id="msg" rows="4" name="message">{!! isset($arr_setting['message_schedule_tour']) ? $arr_setting['message_schedule_tour'] : NULL !!}</textarea>
                                            </div>
                                        </div>
                                        <label class="has-checkbox">
                                            <input id="agree" type="checkbox" name="agree" checked><span>Please arrange for transportation to showflat</span>
                                        </label>
                                        <div class="form-line no-margin text-center a-center">
                                            <button class="btn-nlp small blue" type="submit">Submit                           </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="regis1" role="tabpanel" method="post">
                            <div class="box-border">              
                                <div class="form-style form-sub">
                                    <form class="form-validate" action="{{ route('schedule.showflat.post') }}" method="post">
                                        {!! csrf_field() !!}
                                        <div class="form-subs">
                                            <p>{{ (isset($arr_setting['description_vipp_showflat'])) ? $arr_setting['description_vipp_showflat'] : NULL }}</p>
                                        </div>
                                        <input type="hidden" name="type" value="1">
                                        <input type="hidden" class="project_choose" name="project_id" value="{{ $project->id }}">
                                        <div class="form-line"><span class="input-group-addon">Name <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input id="name" type="text" required name="fullname">
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Phone number <span class="required">*</span></span>
                                            <div class="has-input">
                                                <input id="phone" type="text" minlength="8" pattern="[-+]?[0-9]*[.,]?[0-9]+" required name="phone">
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Email</span>
                                            <input id="email" type="email" name="m_email2">
                                        </div>
                                        <div class="form-line"><span>Budget</span>
                                            <div class="select-budget">
                                                <select class="select-ui" data-placeholder="Budget" tabindex="1" name="budget">
                                                    <option value="">Choose Budgets</option>
                                                    @if(isset($budgets) && count($budgets) > 0)
                                                        @foreach($budgets as $budget)
                                                        <option value="{{ $budget->budgets }}">{{ $budget->budgets }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-line"><span>Number of rooms</span>
                                            <div class="select-budget">
                                                <select class="select-ui" data-placeholder="Num of Room" tabindex="1" name="number_of_rooms">
                                                    @if(!isset($arr_setting['max_rooms']) || $arr_setting['max_rooms'] == null || !is_numeric($arr_setting['max_rooms']))
                                                        @php
                                                            $max_rooms = 10;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $max_rooms = $arr_setting['max_rooms'];
                                                        @endphp
                                                    @endif
                                                    @for($i = 1; $i <= $max_rooms; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Property for</span>
                                            <div class="check-group">
                                                <label class="has-checkbox">
                                                    <input id="own" type="checkbox" name="property[]" checked><span>Own stay</span>
                                                </label>
                                                <label class="has-checkbox">
                                                    <input id="inves" type="checkbox" name="property[]" checked><span>Investment</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-line"><span class="input-group-addon">Message</span>
                                            <textarea id="msg" rows="4" name="messager">{!! isset($arr_setting['message_vvip_registration']) ? $arr_setting['message_vvip_registration'] : NULL !!} </textarea>
                                        </div>
                                        <div class="form-line no-margin text-center a-center">
                                            <button class="btn-nlp small blue" type="submit">Submit  </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .sidebar-filter a{ cursor: pointer }
</style>
<!-- Call function get data -->
<div class="modal fade" id="modalFilePdf" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close btn-close-modal" type="button" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed class="show-pdf" src="../images/brochure.pdf" width="100%" type="application/pdf">
            </div>
            <a class="link-pdf" href="../images/brochure.pdf" target="_blank">PDF ></a>
        </div>
    </div>
</div>
<!-- End Call function get data -->

@endsection

@push('script')
    <script>
        $('.nav-filter li').first().find('ul.content').addClass('show');
        var data = {};
        
        data["project"] = {{ $project->id }};
        if ($('.open-info').first().attr('data-open')) {
            data["open"] = $('.open-info').first().attr('data-open');
        } else {
            data["open"] = null;
        }
        var info = JSON.stringify(data);
        var showPDF = {{ $project->show_pdf }};
        var pdfAll = '{{ $project->pdf_all }}';
        var imageAll = '{{ $project->image_pdf_all }}';

        $.ajax({
            type:'POST',
            url: '{{ route("type.info.post") }}',
            data: {
                info: info
            },
            dataType: 'json',
            success:function(reponse){
                if (reponse['category'] && reponse['type'] && reponse['info']) {
                    $(".type-name").html(reponse['category'].name);
                    $(".sub-type").html(reponse['type'].name);
                    $(".desc-type").html(reponse['info'].content);
                    $(".unit-title").html('Unit');
                    $(".unit-content").html(reponse['info'].unit);
                    if(showPDF === 0){
                        $(".intro-plan").find(".img-bg").css({"background-image":'url('+reponse['info'].image+')'});
                        $(".intro-plan").find("img").attr("src",reponse['info'].image);
                        $(".intro-plan").find("img").attr("data-img",reponse['info'].image);
                        $(".show-pdf").attr('src', reponse['info'].pdf);
                        $(".linkFile").find('img').attr('src', reponse['info'].image);
                        $(".link-pdf").attr('href', reponse['info'].pdf);
                        checkPdfExist(reponse['info'].pdf);
                    } else {
                        $(".intro-plan").find(".img-bg").css({"background-image":'url('+imageAll+')'});
                        $(".intro-plan").find("img").attr("src",imageAll);
                        $(".intro-plan").find("img").attr("data-img",imageAll);
                        $(".show-pdf").attr('src', pdfAll);
                        $(".linkFile").find('img').attr('src', imageAll);
                        $(".link-pdf").attr('href', pdfAll);
                        checkPdfExist(pdfAll);
                    }
                }
            }
        });

        function checkPdfExist(linkPDF){
            if(linkPDF){
                $('.not-had-pdf').hide();
                $('.had-pdf').show();
            } else {
                $('.not-had-pdf').show();
                $('.had-pdf').hide();
            }
        }

        $(".open-info").click(function(){
            var data = {};
            data["open"] = $(this).attr("data-open");
            data["project"] = {{ $project->id }};
            var info = JSON.stringify(data);
            $.ajax({
                type:'POST',
                url: '{{ route("type.info.post") }}',
                data: {
                    info: info
                },
                dataType: 'json',
                success:function(reponse){
                    $(".type-name").html(reponse['category'].name);
                    $(".sub-type").html(reponse['type'].name);
                    // $(".intro-plan").find(".img-bg").css({"background-image":'url('+reponse['info'].image+')'});
                    // $(".intro-plan").find("img").attr("src",reponse['info'].image);
                    $(".desc-type").html(reponse['info'].content);
                    $(".unit-title").html('Unit');
                    $(".unit-content").html(reponse['info'].unit);
                    if(showPDF === 0){
                        $(".intro-plan").find(".img-bg").css({"background-image":'url('+reponse['info'].image+')'});
                        $(".intro-plan").find("img").attr("src",reponse['info'].image);
                        $(".intro-plan").find("img").attr("data-img",reponse['info'].image);
                        $(".show-pdf").attr('src', reponse['info'].pdf);
                        $(".linkFile").find('img').attr('src', reponse['info'].image);
                        $(".link-pdf").attr('href', reponse['info'].pdf);
                        checkPdfExist(reponse['info'].pdf);
                    } else {
                        $(".intro-plan").find(".img-bg").css({"background-image":'url('+imageAll+')'});
                        $(".intro-plan").find("img").attr("src",imageAll);
                        $(".intro-plan").find("img").attr("data-img",imageAll);
                        $(".show-pdf").attr('src', pdfAll);
                        $(".linkFile").find('img').attr('src', imageAll);
                        $(".link-pdf").attr('href', pdfAll);
                        checkPdfExist(pdfAll);
                    }
                }
            });
        });

        $("#select-floor-plan").change(function(){
            if($(this).val() != ""){
                var data = {};
                data["open"] = "open-"+$(this).val();
                data["project"] = {{ $project->id }};
                var info = JSON.stringify(data);
                $.ajax({
                    type:'POST',
                    url: '{{ route("type.info.post") }}',
                    data: {
                        info: info
                    },
                    dataType: 'json',
                    success:function(reponse){
                        $(".type-name").html(reponse['category'].name);
                        $(".sub-type").html(reponse['type'].name);
                        // $(".intro-plan").find(".img-bg").css({"background-image":'url('+reponse['info'].image+')'});
                        // $(".intro-plan").find("img").attr("src",reponse['info'].image);
                        $(".desc-type").html(reponse['info'].content);
                        $(".unit-title").html('Unit');
                        $(".unit-content").html(reponse['info'].unit);
                        if(showPDF === 0){
                            $(".intro-plan").find(".img-bg").css({"background-image":'url('+reponse['info'].image+')'});
                            $(".intro-plan").find("img").attr("src",reponse['info'].image);
                            $(".intro-plan").find("img").attr("data-img",reponse['info'].image);
                            $(".show-pdf").attr('src', reponse['info'].pdf);
                            $(".linkFile").find('img').attr('src', reponse['info'].image);
                            $(".link-pdf").attr('href', reponse['info'].pdf);
                            checkPdfExist(reponse['info'].pdf);
                        } else {
                            $(".intro-plan").find(".img-bg").css({"background-image":'url('+imageAll+')'});
                            $(".intro-plan").find("img").attr("src",imageAll);
                            $(".intro-plan").find("img").attr("data-img",imageAll);
                            $(".show-pdf").attr('src', pdfAll);
                            $(".linkFile").find('img').attr('src', imageAll);
                            $(".link-pdf").attr('href', pdfAll);
                            checkPdfExist(pdfAll);
                        }
                    }
                });
            }else{
                $(".type-name").empty();
                $(".sub-type").empty();
                $(".intro-plan").find(".img-bg").css({"background-image":"none"});
                $(".type-name").find("img").attr("src","#");
                $(".desc-type").empty();
                $(".unit-title").empty();
                $(".unit-content").empty();
            }
        });
        
        $(".date-item").click(function(){
            var date = $(this).data("date");
            var d = new Date(date);
            var day = d.getDate();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            var fulldate = year+"-"+month+"-"+day;
            $("#pick-date").val(fulldate);
            $("#pick-date1").val(fulldate);
        })
    </script>
@endpush