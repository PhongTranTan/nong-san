@extends('frontend.layouts.master')

@push('style')
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-rating.css') }}">
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')
<main class="wrapper grid-view">
    <div class="page-internal-wrapper">
        <!-- ALL NEW LAUNCHES: BANNER-->
        <section class="banner-page-small">
            <div class="slider-slick">
                @if(isset($banner_images) && count($banner_images) > 0)
                @foreach($banner_images as $key => $banner) 
                <div class="slick-slide">
                    <div class="img-bg page lazy" style="background-image:url({{ (isset($banner) && $banner != null) ? asset($banner) : null }});"><img src="{{ (isset($banner) && $banner != null) ? asset($banner) : null }}" alt=""></div>
                    <div class="container text-center">
                        <div class="banner-text title">{{ isset($banner_title[$key]) ? $banner_title[$key] : null }}</div>
                        <div class="banner-text sub dotdotdot">{{ isset($banner_description[$key]) ? $banner_description[$key] : null }}</div>
                    </div>
                    <div class="overlay-dark"> </div>
                </div>
                @endforeach
                @endif
            </div>
        </section>
        
        <section class="report-section section-margin">
            <div class="container nl-container">
                <div class="row gutter-20 block-project">
				@if(isset($linkreport) && $linkreport->count() > 0)
                @php
                    $check_projects = json_decode($linkreport->project_choose);
                    $check_rental = json_decode($linkreport->estimate_rental);
                    $check_capital = json_decode($linkreport->estimate_capital);
                @endphp

                @foreach($check_projects as $key => $project_choice)
					@if(isset($projects) && $projects != null)
                    @foreach($projects as $project)
                    @if($project->id == $project_choice)
                        <div class="col-lg-4 col-md-6">
                            <div class="nl-grid-item">
                                <div class="img">
                                    <div class="owl-carousel">
                                        @if($project->project_slides != null)
                                        @php 
                                            $slides = json_decode($project->project_slides); 
                                        @endphp
                                            @if(count($slides) > 0)
                                                @foreach($slides as $slide)
                                                <div class="img-item">
                                                    <a class="img-bg owl-lazy" href="{{ route('frontend.project.detail', ['slug' => $project->slug]) }}" data-src="{{ $slide }}" target="_blank"></a>
                                                </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="info">
                                    <h3 class="title font-weight-700"><a href="{{ route('frontend.project.detail', ['slug' => $project->slug]) }}" target="_blank">{{ (isset($project->name) && $project->name != null) ? $project->name : null }}</a></h3>
                                    <div class="desc">{{ (isset($project->description) && $project->description != null) ? $project->description : null }}</div>
                                    
                                    <div class="logo">
                                        <div class="img-bg" style="background-image:url('{{ (isset($project->develop) && $project->develop != null) ? asset($project->develop) : null }}')"><img src="{{ (isset($project->develop) && $project->develop != null) ? asset($project->project_logo) : null }}" alt="{{ (isset($project->name) && $project->name != null) ? $project->name : null }}"></div>
                                    </div>
                                </div>
                                <div class="link">
                                    <div class="link-item"><i class="icon icon-marker"></i><span>{{ $project->district_name }}</span></div>
                                    <div class="link-item"><i class="icon icon-paper"></i><span>{{ $project->tenure_name }}</span></div>
                                    <div class="link-item"><i class="icon icon-flat"></i><span>{{ $project->near_place }}</span></div>
                                </div>
                                <div class="estimate">
                                    <div class="estimate-item"><i class="icon icon-chart"></i><span>Estimated Rental Yield</span></div>
                                    <div class="estimate-star">
                                        <div class="rating">
                                           {{--  <div class="empty-stars"></div>
                                            <div class="full-stars" style="width:70%"></div> --}}
                                            <input type="hidden" name="estimated_rental_yield" data-filled="fas fa-star" data-empty="far fa-star" class="rating-show" disabled="disabled" value="{{ isset($check_rental[$key]) ? $check_rental[$key] : 0 }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="estimate" style="border-top: none">
                                    <div class="estimate-item"><i class="icon icon-chart"></i><span>Estimated Capital Appreciation</span></div>
                                    <div class="estimate-star">
                                        <div class="rating">
                                            {{-- <div class="empty-stars"></div>
                                            <div class="full-stars" style="width:100%"></div> --}}
                                            <input type="hidden" name="estimated_rental_yield" data-filled="fas fa-star" data-empty="far fa-star" class="rating-show" disabled="disabled" value="{{ isset($check_capital[$key]) ? $check_capital[$key] : 0 }}" />
                                        </div>
                                    </div>
                                </div>
                                @if($project->tag != null)
                                <div class="tag">
                                    @if(count($tags = explode(',',$project->tag)))
                                        @foreach($tags as $key => $tag)
                                        <span>{{ $tag }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                @endif
                                <div class="share"><a class="whatapps" href="https://wa.me/{{ (isset($project->whatsapp) && $project->whatsapp != null) ? $project->whatsapp : NULL }}"><i class="icon icon-hotline"></i></a>
                                    <div class="share-btn">
                                        <div class="icon-share-white"> 
                                            <div class="open-share">
                                                <div class="group-share" data-json="{&quot;id&quot;:&quot;{{ $project->id }}&quot;, &quot;url&quot;: {&quot;fbLink&quot;:&quot;{{ route('frontend.project.detail', ['slug' => $project->slug]) }}&quot;, &quot;twLink&quot;:&quot;{{ route('frontend.project.detail', ['slug' => $project->slug]) }}&quot;, &quot;lindLink&quot;:&quot;{{ route('frontend.project.detail', ['slug' => $project->slug]) }}&quot;}}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endforeach
                    @endif
                @endforeach
                @endif
                </div>
				
				{{-- @if(!empty($blocks['CUSTOM-REPORT-DESCRIPTION']) && $blocks->get('CUSTOM-REPORT-DESCRIPTION')->first())
                	<div class="p-desc text-center">{!! $blocks['CUSTOM-REPORT-DESCRIPTION'][0]->description !!}</div>
				@endif --}}
                
                @if($linkreport->description != null)
                    <div class="p-desc text-center">{!! $linkreport->description !!}</div>
                @endif

                <!--LIST OF PROJECT-->
                <div class="manage-project">
                    <div class="title text-center">Schedule Showflat Tour</div>
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 content-left">
                                <div class="header">
                                    <h5 class="title-fav">Recommended Projects</h5>
                                </div>
                                <div class="open-fav">  
                                    <div class="fav-box">                                   
                                        <div class="content-fav">
                                            <div class="list-item scroll-ui">
                                                <div class="simple-bar-report swiper-container">
                                                    <div class="swiper-wrapper">

                                                    @foreach($check_projects as $key => $project_choice)
                                                    @if(isset($projects) && $projects != null)
                                                        @foreach($projects as $project)
                                                        @if($project->id == $project_choice)
                                                        @if($project->project_slides != null)
                                                            @php 
                                                                $slide_reports = json_decode($project->project_slides); 
                                                            @endphp
                                                        @endif
                                                        <div class="fav-line-rp swiper-slide">
                                                            <input type="hidden" class="check-report" value="{{ $project->id }}" data-check="{{ $project->id }}">
                                                            <div class="fav-line-left">                                      
                                                                <a class="img-bg" href="{{ route('frontend.project.detail', ['slug' => $project->slug]) }}" target="_blank" style="background-image:url('{{ isset($slide_reports[0]) ? $slide_reports[0] : $project->project_logo }}')"><img src="{{ isset($slide_reports[0]) ? $slide_reports[0] : $project->project_logo }}" alt=""></a>
                                                            </div>
                                                            <div class="fav-line-right"> 
                                                                <a class="title" href="{{ route('frontend.project.detail', ['slug' => $project->slug]) }}">{{ (isset($project->name) && $project->name != null) ? $project->name : null }}</a>
                                                                    <div class="info"><span>{{ $project->district_name }}</span><span>{{ $project->type_name }}</span>
                                                                        <input class="check-fav-line-{{ $project->id }}" type="checkbox" name="check" id="checkedmodal{{ $project->id }}">
                                                                        <label for="checkedmodal{{ $project->id }}"> </label>
                                                                    </div>
                                                                </div>
                                                            <div class="btn-close-report"> </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    @endif
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $current_day = \Carbon\Carbon::now();
                            @endphp
                            <div class="col-lg-6 col-md-12 content-right">
                                <div class="schedule-tour">
                                    <ul class="nav tabs-desc" role="tablist">
                                        <li class="active"><a class="tab-title active show" href="#sche1" role="tab" data-toggle="tab">Scheduled Tour</a></li>
                                        <li><a class="tab-title" href="#regis1" role="tab" data-toggle="tab">VVIP Registration</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="sche1" role="tabpanel">
                                            <div class="box-border">              
                                                <div class="form-style form-sub">
                                                    <div class="form-subs">
                                                        <p>{{ (isset($arr_setting['description_schedule_showflat'])) ? $arr_setting['description_schedule_showflat'] : NULL }}</p>
                                                    </div>
                                                   <form class="form-validate" action="{{ route('schedule.showflat.post') }}" method="post">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" class="project_choose_custom" name="project_id" value="{{ implode(',', $check_projects) }}">
                                                        <div class="form-line"><span class="input-group-addon">Name <span class="required">*</span></span>
                                                            <div class="has-input">
                                                                <input id="name" type="text" required name="fullname">
                                                            </div>
                                                        </div>
                                                        <div class="form-line"><span class="input-group-addon">Phone number <span class="required">*</span></span>
                                                            <div class="has-input">
                                                                <input id="phone" type="text" minlength="10" pattern="[-+]?[0-9]*[.,]?[0-9]+" required name="phone">
                                                            </div>
                                                        </div>
                                                        <div class="form-line"><span class="input-group-addon">Date <span class="required">*</span></span>
                                                            <div class="day-stream">
                                                                <div class="dayline-carousel">
                                                                    <div class="slick-carousel">
                                                                        @for($i = 1; $i <= 7; $i++)
                                                                        @php
                                                                            $next_day = $current_day->addDay();
                                                                            $date_of_next = $next_day->format("d M y");
                                                                            $day_of_week = $next_day->format("D");
                                                                        @endphp
                                                                        <div class="gallery-item date-item" data-date="{{ $date_of_next }}">    
                                                                            <span>{{ $date_of_next }}</span>
                                                                            <p class="font-weight-700">{{ $day_of_week }}</p>
                                                                        </div>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="has-input">
                                                            <input type="hidden" name="date" id="pick-date-report">
                                                        </div>
                                                        <div class="form-line" id="timepicker">
                                                            <span class="input-group-addon">Time <span class="required">*</span></span>
                                                            <div class="has-input">
                                                                <input class="timepicker" id="time" type="text" required name="time">
                                                            </div>
                                                        </div>
                                                        <div class="form-line"><span class="input-group-addon">Message <span class="required">*</span></span>
                                                            <div class="has-input">
                                                                <textarea id="msg" rows="4" name="message">I would like to schedule a show flat tour for my favourite projects</textarea>
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
                                        <div class="tab-pane" id="regis1" role="tabpanel">
                                            <div class="box-border">              
                                                <div class="form-style form-sub">
                                                    <div class="form-subs">
                                                        <p>{{ (isset($arr_setting['description_schedule_showflat'])) ? $arr_setting['description_schedule_showflat'] : NULL }}</p>
                                                    </div>
                                                    <form class="form-validate" action="{{ route('schedule.showflat.post') }}" method="post">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="type" value="1">
                                                        <input type="hidden" class="project_choose_custom" name="project_id" value="{{ implode(',', $check_projects) }}">
                                                        <div class="form-line"><span class="input-group-addon">Name <span class="required">*</span></span>
                                                            <input id="name" type="text" required name="fullname">
                                                        </div>
                                                        <div class="form-line"><span class="input-group-addon">Phone number <span class="required">*</span></span>
                                                            <input id="phone" type="text" minlength="10" pattern="[-+]?[0-9]*[.,]?[0-9]+" required name="phone">
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
                                                                    <input id="own" type="checkbox" name="property[]" value="1" checked><span>Own stay</span>
                                                                </label>
                                                                <label class="has-checkbox">
                                                                    <input id="inves" type="checkbox" name="property[]" value="2" checked><span>Investment</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-line"><span class="input-group-addon">Message <span class="required">*</span></span>
                                                            <textarea id="msg" rows="4" name="message">I would like to register as a VVIP for my favourite projects.                                  </textarea>
                                                        </div>
                                                        <div class="form-line no-margin text-center a-center">
                                                            <button class="btn-nlp small blue" type="submit">Submit</button>
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
            </div>
        </section>
    </div>
</main>
<style>
    .clearfix{ clear: both; }
    .pagination{ text-align: center; margin: 15px auto; }
    .open-fav .fav-box .content-fav .simple-bar-report .fav-line,
    .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp,
    .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line,
    .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp {
      position: relative;
      display: -webkit-box;
      display: flex;
      margin-bottom: 30px; }
      @media (max-width: 767.98px) {
        .open-fav .fav-box .content-fav .simple-bar-report .fav-line,
        .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp,
        .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line,
        .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp {
          margin-bottom: 0; } }
      .open-fav .fav-box .content-fav .simple-bar-report .fav-line:after,
      .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp:after,
      .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line:after,
      .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp:after {
        content: "";
        position: absolute;
        bottom: -13px;
        left: 0;
        width: 100%;
        height: 1px;
        background: #ebebeb; }
        @media (min-width: 768px) and (max-width: 991.98px) {
          .open-fav .fav-box .content-fav .simple-bar-report .fav-line:after,
          .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp:after,
          .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line:after,
          .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp:after {
            bottom: 6px;
            width: 90%; } }
        @media (max-width: 767.98px) {
          .open-fav .fav-box .content-fav .simple-bar-report .fav-line:after,
          .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp:after,
          .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line:after,
          .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp:after {
            bottom: 20px; } }
      .open-fav .fav-box .content-fav .simple-bar-report .fav-line .img-bg:after,
      .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp .img-bg:after,
      .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line .img-bg:after,
      .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp .img-bg:after {
        padding-top: 71.42857%; }
      .open-fav .fav-box .content-fav .simple-bar-report .fav-line .fav-line-left,
      .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp .fav-line-left,
      .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line .fav-line-left,
      .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp .fav-line-left {
        width: 52%; }
        @media (max-width: 767.98px) {
          .open-fav .fav-box .content-fav .simple-bar-report .fav-line .fav-line-left,
          .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp .fav-line-left,
          .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line .fav-line-left,
          .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp .fav-line-left {
            width: 100%; } }
      .open-fav .fav-box .content-fav .simple-bar-report .fav-line .fav-line-right,
      .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp .fav-line-right,
      .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line .fav-line-right,
      .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp .fav-line-right {
        width: 100%;
        margin-left: 15px; }
        @media (max-width: 767.98px) {
          .open-fav .fav-box .content-fav .simple-bar-report .fav-line .fav-line-right,
          .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp .fav-line-right,
          .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line .fav-line-right,
          .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp .fav-line-right {
            margin-top: 10px;
            margin-left: 0; } 
        .open-fav .fav-box .content-fav .simple-bar-report .fav-line,
        .open-fav .fav-box .content-fav .simple-bar-report .fav-line-rp,
        .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line,
        .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp {
          position: relative;
          display: -webkit-box;
          display: block;
          margin-bottom: 30px; }
        .open-fav .fav-box-none .content-fav .simple-bar-report .fav-line-rp .fav-line-left {
        width: 100%; } }
</style>
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
<script src="{{ url('assets/js/library.js') }}"></script>
<script async src="{{ url('assets/js/pages.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/bootstrap-rating.min.js') }}"></script>
<script>
	$(".rating-show").rating();
    $(document).on("click", ".btn-close-report", function() {
        $(this).parent().remove();
        var list = $(".check-report");
        var check = '';
        $.each(list, function(index, element) {
            check += $(this).attr("data-check")+","; 
        });
        $(".project_choose_custom").val(check.slice(0, -1));
    });

    $(".date-item").click(function(){
        var date = $(this).data("date");
        var d = new Date(date);
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        var fulldate = year+"-"+month+"-"+day;
        $("#pick-date-report").val(fulldate);
    });
    
</script>    
@endpush
