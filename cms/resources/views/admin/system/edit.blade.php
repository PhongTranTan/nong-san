@extends("admin.layouts.master")

@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {!! trans("admin_system.list") !!}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="body">

                    @include("admin.layouts.partials.message")

                    <form id="form-form" method="post"
                          action="{!! route("admin.system.update", '0110') !!}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                    
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">System</a></li>
                            <li><a data-toggle="tab" href="#menu1">Socials</a></li>
                            <li><a data-toggle="tab" href="#menu2">Website Info</a></li>
                            <li><a data-toggle="tab" href="#menu3">Schedule Showflat</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                              <h4>System</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans("admin_project.form.logo") !!}</div>
                                        <div class="form-group">
                                            @component('admin.layouts.components.upload_photo', [
                                                'image' => $system['logo']['content'] ?? null,
                                                'name' => 'logo',
                                            ])
                                            @endcomponent
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.max_rooms') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="max_rooms" class="form-control"
                                                       value="{{ $system['max_rooms']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.address') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="address" class="form-control"
                                                       value="{{ $system['address']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.phone') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="phone" class="form-control"
                                                       value="{{ !empty($system['phone']) ?  $system['phone']['content'] : null }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.whatsapp') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="whatsapp" class="form-control"
                                                       value="{{ !empty($system['whatsapp']) ?  $system['whatsapp']['content'] : null }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.email') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control"
                                                       value="{{ $system['email']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.google_analytic') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="7" id="google_analytic" class="form-control no-resize"
                                                          name="google_analytic">{{ $system['google_analytic']['content'] ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.chat_script') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="7" id="chat_script" class="form-control no-resize"
                                                          name="chat_script">{{ $system['chat_script']['content'] ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="menu1" class="tab-pane fade">

                                <h4>{{ trans('admin_system.social') }}</h4>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.facebook') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="facebook" class="form-control"
                                                       value="{{  $system['facebook']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.linkedin') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="linkedin" class="form-control"
                                                       value="{{  $system['linkedin']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.youtube') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="youtube" class="form-control"
                                                       value="{{  $system['youtube']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div id="menu2" class="tab-pane fade">

                                <h4>{{ trans('admin_system.website_info') }}</h4>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.website_title') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="website_title" name="website_title" class="form-control"
                                                       value="{{ $system['website_title']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.website_description') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="website_description" class="form-control"
                                                       value="{{ $system['website_description']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.website_keywords') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="website_keywords" class="form-control"
                                                       value="{{ $system['website_keywords']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.description_footer') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="7" id="description_footer" class="form-control no-resize"
                                                          name="description_footer">{{ $system['description_footer']['content'] ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="menu3" class="tab-pane fade">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.description_schedule_showflat') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="7" id="description_schedule_showflat" class="form-control no-resize"
                                                          name="description_schedule_showflat">{{ $system['description_schedule_showflat']['content'] ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.description_vipp_showflat') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="7" id="description_vipp_showflat" class="form-control no-resize"
                                                          name="description_vipp_showflat">{{ $system['description_vipp_showflat']['content'] ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.message_schedule_tour') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="7" id="message_schedule_tour" class="form-control no-resize"
                                                          name="message_schedule_tour">{{ $system['message_schedule_tour']['content'] ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.message_vvip_registration') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="7" id="message_vvip_registration" class="form-control no-resize"
                                                          name="message_vvip_registration">{{ $system['message_vvip_registration']['content'] ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => ''
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
