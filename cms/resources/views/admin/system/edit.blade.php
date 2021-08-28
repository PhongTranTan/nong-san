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
                            <li><a data-toggle="tab" href="#socials">Socials</a></li>
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
                                </div>
                            </div>
                            <div id="socials" class="tab-pane">
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
