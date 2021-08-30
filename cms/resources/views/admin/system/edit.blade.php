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
                        enctype="multipart/form-data"
                    >
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">System</a></li>
                            <li><a data-toggle="tab" href="#gallery">Gallery</a></li>
                            <li><a data-toggle="tab" href="#images_footer">Selider Footer</a></li>
                            <li><a data-toggle="tab" href="#footer">Footer</a></li>
                            <li><a data-toggle="tab" href="#ads">ADS</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                              <h4>System</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="font-bold col-green">{!! trans("admin_project.form.logo") !!}</div>
                                        <div class="form-group">
                                            @component('admin.layouts.components.upload_photo', [
                                                'image' => $system['logo']['content'] ?? null,
                                                'name' => 'logo',
                                            ])
                                            @endcomponent
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.website_title') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="website_title" name="website_title" class="form-control"
                                                       value="{{ $system['website_title']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.website_keywords') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="website_keywords" class="form-control"
                                                       value="{{ $system['website_keywords']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.website_description') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="website_description" class="form-control"
                                                       value="{{ $system['website_description']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.contact_title') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="contact_title" name="contact_title" class="form-control"
                                                       value="{{ $system['contact_title']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.contact_description') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="7" id="contact_description" class="form-control no-resize"
                                                            name="contact_description">{{ $system['contact_description']['content'] ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.phone') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="phone" class="form-control"
                                                       value="{{ !empty($system['phone']) ?  $system['phone']['content'] : null }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.email') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control"
                                                       value="{{ $system['email']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.address') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="address" class="form-control"
                                                       value="{{ $system['address']['content'] ?? null }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="gallery" class="tab-pane">
                                @for ($i = 0; $i <= 15; $i++)
                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans("admin_project.form.logo") !!}</div>
                                        <div class="form-group">
                                            @component('admin.layouts.components.upload_photo', [
                                                'image' => $system['images']['content'][$i]['image'] ?? null,
                                                'name' => "images[$i][image]",
                                            ])
                                            @endcomponent
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div id="images_footer" class="tab-pane">
                                @for ($i = 0; $i <= 11; $i++)
                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans("admin_project.form.logo") !!}</div>
                                        <div class="form-group">
                                            @component('admin.layouts.components.upload_photo', [
                                                'image' => $system['images_footer']['content'][$i]['image'] ?? null,
                                                'name' => "images_footer[$i][image]",
                                            ])
                                            @endcomponent
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div id="ads" class="tab-pane">
                                @for ($i = 0; $i <= 1; $i++)
                                    <div class="col-md-4">
                                        <div class="font-bold col-green">{!! trans("admin_project.form.logo") !!}</div>
                                        <div class="form-group">
                                            @component('admin.layouts.components.upload_photo', [
                                                'image' => $system['ads']['content'][$i]['image'] ?? null,
                                                'name' => "ads[$i][image]",
                                            ])
                                            @endcomponent
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div id="footer" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="font-bold col-green">{!! trans('admin_system.form.description_footer') !!}</div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea rows="7" 
                                                    id="description_footer" 
                                                    class="form-control no-resize"
                                                    name="description_footer">{{ $system['description_footer']['content'] ?? null }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => ''
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
