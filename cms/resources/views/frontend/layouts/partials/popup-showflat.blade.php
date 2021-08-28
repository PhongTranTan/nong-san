<div class="modal fade" id="modalPopovers" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button class="close btn-close-modal" type="button" data-dismiss="modal" aria-label="Close"></button>
            <div class="row">
                <div class="col-lg-6 col-md-12 content-left swiper-slide">
                    <div class="modal-header">
                        <h5 class="modal-title title-fav" id="exampleModalLabel">My Favourite Projects                              </h5>
                    </div>
                    <div class="open-fav">                   
                        <div class="fav-box">                                   
                            <div class="content-fav not-rp">
                                <div class="list-item scroll-ui">
                                    <div class="simple-bar-showflat swiper-container">
                                        <div class="empty-noti text-center mg-topbot50 mt-50p d-none"> <a href="{{ getPageUrlByCode('ALL-PROJECTS') }}">Add projects to your favourite to schedute showflat tour                             </a></div>
                                        <div class="swiper-wrapper" id="simple-bar-showflat">
                                        
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
                <div class="col-lg-6 col-md-12 content-right swiper-slide">
                    <div class="schedule-tour">
                        <ul class="nav tabs-desc" role="tablist">
                            <li class="active"><a class="tab-title active show" href="#sche" role="tab" data-toggle="tab">Schedule Tour</a></li>
                            <li><a class="tab-title" href="#regis" role="tab" data-toggle="tab">VVIP Registration</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="sche" role="tabpanel">
                                <div class="box-border">              
                                    <div class="form-style form-sub">
                                        <form class="form-validate scheduleForm" action="{{ route('schedule.showflat.post') }}" method="post">
                                            {!! csrf_field() !!}
                                            <div class="form-subs">
                                                <p>{{ (isset($arr_setting['description_schedule_showflat'])) ? $arr_setting['description_schedule_showflat'] : NULL }}</p>
                                            </div>
                                            <input type="hidden" class="project_choose" name="project_id">
                                            <div class="form-line">
                                                <span class="input-group-addon">Name <span class="required">*</span></span>
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
                                                            @for($i = 1; $i <= 14; $i++)
                                                            @php
                                                                $next_day = $current_day->addDay();
                                                                $date_of_next = $next_day->format("d M y");
                                                                $day_of_week = $next_day->format("D");
                                                            @endphp
                                                            <label class="gallery-item date-item" data-date="{{ $date_of_next }}">    <div class="block">
                                                                    <input type="radio" name="date" value="{{ date("Y-m-d", strtotime($date_of_next)) }}"><span>{{ $date_of_next }}</span>
                                                                    <p class="font-weight-700">{{ $day_of_week }}</p>
                                                                </div>
                                                            </label>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                             <div class="has-input">
                                                <input type="hidden" name="date" id="pick-date">
                                            </div> --}}
                                            <div class="form-line" id="timepicker"><span class="input-group-addon">Time <span class="required">*</span></span>
                                                <div class="has-input">
                                                    <input class="timepicker" id="time" type="text" required name="time">
                                                </div>
                                            </div>
                                            <div class="form-line"><span class="input-group-addon">Message <span class="required">*</span></span>
                                                <div class="has-input">
                                                    <textarea id="msg" rows="4" name="message">{!!isset($arr_setting['message_schedule_tour'])?$arr_setting['message_schedule_tour']:NULL!!}</textarea>
                                                </div>
                                            </div>
                                            <label class="has-checkbox">
                                                <input id="agree" type="checkbox" name="agree" value="Please arrange for transportation to showflat" checked><span>Please arrange for transportation to showflat</span>
                                            </label>
                                            <div class="form-line no-margin text-center a-center">
                                                <button class="btn-nlp small blue" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="regis" role="tabpanel">
                                <div class="box-border">              
                                    <div class="form-style form-sub">
                                        <form class="form-validate" action="{{ route('schedule.showflat.post') }}" method="post">
                                            {!! csrf_field() !!}
                                            <div class="form-subs">
                                                <p>{{ (isset($arr_setting['description_vipp_showflat'])) ? $arr_setting['description_vipp_showflat'] : NULL }}</p>
                                            </div>
                                            <input type="hidden" name="type" value="1">
                                            <input type="hidden" class="project_choose" name="project_id">
                                            <div class="form-line">
                                                <span class="input-group-addon">Name <span class="required">*</span></span>
                                                <div class="has-input">
                                                    <input id="name" type="text" required name="fullname">
                                                </div>
                                            </div>
                                            <div class="form-line">
                                                <span class="input-group-addon">Phone number <span class="required">*</span></span>
                                                <div class="has-input">
                                                    <input id="phone" type="text" minlength="10" pattern="[-+]?[0-9]*[.,]?[0-9]+" required name="phone">
                                                </div>
                                            </div>
                                            <div class="form-line"><span class="input-group-addon">Email</span>
                                                <div class="has-input">
                                                    <input id="email" type="email" name="m_email2">
                                                </div>
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
                                                    <select class="select-ui" data-placeholder="Num of Room" required tabindex="1" name="number_of_rooms">
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
                                            <div class="form-line"><span class="input-group-addon">Message</span>
                                                <div class="has-input">
                                                    <textarea id="msg2" rows="4" name="messager">{!!isset($arr_setting['message_vvip_registration'])?$arr_setting['message_vvip_registration']:NULL!!}</textarea>
                                                </div>
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