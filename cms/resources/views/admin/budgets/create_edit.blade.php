@extends("admin.layouts.master")

@section("meta")
    <meta name="linkDatatable" content="{{ route('admin.budgets.datatable') }}"/>
@endsection

@section("style")
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                @include('admin.layouts.partials.message')

                @component('admin.layouts.components.form', [
                    'form_method' =>  empty($budgets) ? 'POST' : 'PUT',
                    'form_url' => empty($budgets) ? route("admin.budgets.store") : route("admin.budgets.update", $budgets->id)
                ])
                    <!-- Nav tabs -->
                        @include('admin.translation.nav_tab', [
                            'default_tabs' => [
                                [
                                    'id' => 'general',
                                    'name' => trans('admin_tab.general'),
                                    'path' => 'admin.budgets.partials.general'
                                ]
                            ],
                            'object_trans' => $budgets ?? null,
                            'default_tab' => 'general',
                            'form_fields' => [
                                
                            ],
                            'translation_file' => 'admin_tenure'
                        ])

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.budgets.index")
                        ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
<style>
    .tab-nav-right li[role="presentation"]:last-child{ display: none; }
</style>
@endsection

@section("script")
    @include("admin.layouts.partials.modal-delete")

    <!--dataTables plugin-->
    <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js" type="text/javascript"></script>

    <script type="text/javascript" src="/assets/admin/js/pages/budgets.create.js?v=1"></script>
@endsection
