@extends("admin.layouts.master")

@section("meta")
    
@endsection

@section("style")
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
    <link rel="stylesheet" href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-rating.css">
    <style>
        .bootstrap-tagsinput .tag {
            font-size: 13px;
        }
        .bootstrap-tagsinput .label-info {
            background-color: #4caf50;
        }
        a.mo-rong, a.thu-gon{ display: block; text-align: center; text-decoration: none }
    </style>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                @include('admin.layouts.partials.message')

                @component('admin.layouts.components.form', [
                    'form_method' =>  empty($data) ? 'POST' : 'PUT',
                    'form_url' => empty($data) ? route("admin.product.types.store") : route("admin.product.types.update", $data->id)
                ])
                    <!-- Nav tabs -->
                        @include('admin.translation.nav_tab', [
                            'default_tabs' => [
                                [
                                    'id' => 'general',
                                    'name' => trans('admin_tab.general'),
                                    'path' => 'admin.product_type.partials.general'
                                ]
                            ],
                            'object_trans' => $data ?? null,
                            'default_tab' => 'general',
                            'form_fields' => [
                                ['type' => 'text', 'name' => 'name']
                            ],
                            'form_plugins' => ['ckeditor'],
                            'tab_seo' => true,
                            'metadata' => $metadata ?? null,
                            'translation_file' => 'admin_project'
                        ])
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.product.types.index")
                        ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("admin.layouts.partials.modal-delete")
    <!--dataTables plugin-->
    <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>
    <script type="text/javascript" src="/assets/admin/js/pages/product_type.create.js"></script>
@endsection
