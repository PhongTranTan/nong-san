@extends("admin.layouts.master")

@section("meta")
    <meta name="linkGetBlock" content="{{ route('admin.page.load.block', ['page_id' => $page->id ?? '' ]) }}"/>
@endsection

@section("style")
    <link rel="stylesheet" href="/assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.css"/>

    <style>
        .module-item h4{
            display: none;
            margin-top: 0;
        }
        .module-item .collapsed + h4{
            display: block;
        }
        .module-items .module-item .module-items .module-item{
            border: 10px solid #4e93fc !important;
        }
    </style>
@endsection

@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                    @include("admin.layouts.partials.message")

                    @component('admin.layouts.components.form', [
                        'form_method' =>  empty($page) ? 'POST' : 'PUT',
                        'form_url' => empty($page) ? route("admin.page.store") : route("admin.page.update", $page->id)
                    ])
                        @include('admin.translation.nav_tab', [
                            'default_tabs' => [
                                [
                                    'id' => 'general',
                                    'name' => trans('admin_tab.general'),
                                    'path' => 'admin.page.partials.general'
                                ],
                                [
                                    'id' => 'blocks',
                                    'name' => trans('admin_tab.blocks'),
                                    'path' => 'admin.page.partials.blocks'
                                ]
                            ],
                            'object_trans' => $page ?? null,
                            'default_tab' => 'general',
                            'form_fields' => [
                                ['type' => 'text', 'name' => 'slug'],
                                ['type' => 'text', 'name' => 'title'],
                                ['type' => 'textarea', 'name' => 'description'],
                                ['type' => 'ckeditor', 'name' => 'content']
                            ],
                            'form_plugins' => ['ckeditor'],
                            'tab_seo' => true,
                            'metadata' => $metadata ?? null,
                            'translation_file' => 'admin_page',
                        ])

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.page.index")
                        ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="/assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js" type="text/javascript"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>

    @if($composer_locale !== 'en')
        <script type="text/javascript" src="/assets/plugins/jquery-validation/localization/messages_{{ $composer_locale }}.js"></script>
    @endif

    <script type="text/javascript" src="/assets/admin/js/pages/page.create.js?v=1.1"></script>
@endsection