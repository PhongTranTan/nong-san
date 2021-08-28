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
                    'form_method' =>  empty($sibor_rates) ? 'POST' : 'PUT',
                    'form_url' => empty($sibor_rates) ? route("admin.siborrates.store") : route("admin.siborrates.update", $sibor_rates->id)
                ])
                    <!-- Nav tabs -->
                        @include('admin.translation.nav_tab', [
                            'default_tabs' => [
                                [
                                    'id' => 'general',
                                    'name' => trans('admin_tab.general'),
                                    'path' => 'admin.sibor_rates.partials.general'
                                ],
                                [
                                    'id' => 'sibor-rates',
                                    'name' => trans('admin_tab.sibor_rates'),
                                    'path' => 'admin.sibor_rates.partials.sibor_rates'
                                ],
                            ],
                            'object_trans' => $sibor_rates ?? null,
                            'default_tab' => 'general',
                            'translation_file' => 'admin_sibor_rates'
                        ])

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.siborrates.index")
                        ])
                    @endcomponent

                    
                    <div class="append-sibor-hidden" style="display: none;">
                        <div id="plus-sibor">
                        <div class="col-md-12">
                            <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
                            <div class="col-md-4">
                            <div class="font-bold col-green">{!! trans("admin_sibor_rates.form.month_sibor") !!}</div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="month_sibor[]">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="font-bold col-green">{!! trans("admin_sibor_rates.form.percent_sibor") !!}</div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="percent_sibor[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
    .tab-nav-right li[role="presentation"]:last-child{ display: none; }
</style>
@endsection

@section("script")

    <!-- Jquery Validation Plugin Css -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>
    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/assets/admin/js/pages/siborrates.create.js?v=1"></script>
    @if($composer_locale !== 'en')
        <script type="text/javascript"
                src="/assets/plugins/jquery-validation/localization/messages_{{ $composer_locale }}.js"></script>
    @endif
@endsection
