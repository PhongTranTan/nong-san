@extends("admin.layouts.master")

@section("meta")
@endsection

@section("style")
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
@endsection

@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                @include('admin.layouts.partials.message')

                @component('admin.layouts.components.form', [
                    'form_method' =>  empty($banner) ? 'POST' : 'PUT',
                    'form_url' => empty($banner) ? route("admin.banner.store") : route("admin.banner.update", $banner->id)
                ])
                    <!-- Nav tabs -->
                        @include('admin.translation.nav_tab', [
                            'default_tabs' => [
                                [
                                    'id' => 'general',
                                    'name' => trans('admin_tab.general'),
                                    'path' => 'admin.banner.partials.general'
                                ]
                            ],
                            'object_trans' => $banner ?? null,
                            'default_tab' => 'general',
                            'form_fields' => [
                                ['type' => 'text', 'name' => 'title'],
                                ['type' => 'textarea', 'name' => 'description']
                            ],
                            'tab_seo' => false,
                            'metadata' => $metadata ?? null,
                            'translation_file' => 'admin_banner'
                        ])

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.banner.index")
                        ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>

    @if($composer_locale !== 'en')
        <script type="text/javascript"
                src="/assets/plugins/jquery-validation/localization/messages_{{ $composer_locale }}.js"></script>
    @endif
@endsection
