@extends("admin.layouts.master")

@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                @include("admin.layouts.partials.message")

                @component('admin.layouts.components.form', [
                'form_method' =>  empty($country) ? 'POST' : 'PUT',
                'form_url' => empty($country) ? route("admin.country.store") : route("admin.country.update", $country->id)
                ])
                    <!-- Nav tabs -->
                        @include('admin.translation.nav_tab', [
                            'object_trans' => $country ?? null,
                            'default_tab' => $composer_locale,
                            'form_fields' => [
                                ['type' => 'text', 'name' => 'name']
                            ],
                            'translation_file' => 'admin_country'
                        ])

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.country.index")
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
        <script type="text/javascript"
                src="/assets/plugins/jquery-validation/localization/messages_{{ $composer_locale }}.js"></script>
    @endif

    <script type="text/javascript" src="/assets/admin/js/pages/country.create.js?v=1.0"></script>
@endsection