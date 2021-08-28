@extends("admin.layouts.master")

@section("meta")
    <meta name="linkSortMenuItem" content="{{ route('admin.menu.item.sort') }}"/>
@endsection

@section("style")
    <link rel="stylesheet" href="/assets/plugins/jquery-ui-sortable/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/admin/css/menu.item.css">
@endsection


@section("content")
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a href="{!! route("admin.menu.item.create") !!}" class="btn btn-info waves-effect pull-right">
                    <i class="material-icons">add</i>
                    <span>{!! trans("button.create") !!}</span>
                </a>
                <h2>
                    {!! trans("admin_menu_item.list") !!}
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="body" id="menu-item">

                @include("admin.layouts.partials.message")

                {!! $menu_item !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
    @include("admin.layouts.partials.modal-delete")

    <!-- Start sortable -->
    <script src="/assets/plugins/jquery-ui-sortable/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-ui-sortable/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- End sortable -->

    <script type="text/javascript" src="/assets/admin/js/pages/menu_item.index.js?v=1.0"></script>
@endsection