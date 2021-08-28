@extends("admin.layouts.master")

@section("meta")

@endsection

@section("style")
    <!--select 2 plugin-->
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css"/>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                @include("admin.layouts.partials.message")

                @component('admin.layouts.components.form', [
                    'form_method' =>  empty($user) ? 'POST' : 'PUT',
                    'form_url' => empty($user) ? route("admin.user.store") : route("admin.user.update", $user->id)
                ])
                    @include("admin.user.partials.tab")

                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="information">
                                @include("admin.user.partials.information")
                            </div>
                            {{--
                            <div role="tabpanel" class="tab-pane fade " id="permission">
                                @include("admin.user.partials.permission")
                            </div>
                            --}}

                        </div>

                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.user.index")
                        ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <!--select 2 plugin-->
    <script src="/assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>

    @if($composer_locale !== 'en')
        <script type="text/javascript"
                src="/assets/plugins/jquery-validation/localization/messages_{{ $composer_locale }}.js"></script>
    @endif

    <script type="text/javascript" src="/assets/admin/js/pages/user.create.js?v=1.0"></script>
@endsection