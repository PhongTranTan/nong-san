@extends("admin.layouts.master")

@section("meta")
@endsection

@section("style")
@endsection

@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    @include("admin.layouts.partials.message")

                    @component('admin.layouts.components.form', [
                        'form_method' =>  empty($theme) ? 'POST' : 'PUT',
                        'form_url' => empty($theme) ? route("admin.theme.store") : route("admin.theme.update", $theme->filename)
                    ])

                        @include("admin.theme.partials.form")

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.theme.index")
                        ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <!-- Jquery Validation Plugin Css -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>

    @if($composer_locale !== 'en')
        <script type="text/javascript" src="/assets/plugins/jquery-validation/localization/messages_{{ $composer_locale }}.js"></script>
    @endif

    <script type="text/javascript" src="/assets/admin/js/pages/theme.create.js?v=1"></script>
@endsection