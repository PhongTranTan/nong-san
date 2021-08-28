@extends("admin.layouts.master")

@section("meta")
    <meta name="linkDatatable" content="{{ route('admin.linkreport.datatable') }}"/>
@endsection

@section("style")
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
    <link rel="stylesheet" href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-rating.css">
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                @include('admin.layouts.partials.message')

                @component('admin.layouts.components.form', [
                    'form_method' =>  empty($linkreport) ? 'POST' : 'PUT',
                    'form_url' => empty($linkreport) ? route("admin.linkreport.store") : route("admin.linkreport.update", $linkreport->id)
                ])
                    <!-- Nav tabs -->
                        @include('admin.translation.nav_tab', [
                            'default_tabs' => [
                                [
                                    'id' => 'general',
                                    'name' => trans('admin_tab.general'),
                                    'path' => 'admin.linkreport.partials.general'
                                ],
                                [
                                    'id' => 'custom-banner',
                                    'name' => trans('admin_tab.banner'),
                                    'path' => 'admin.linkreport.partials.banner'
                                ],
                            ],
                            'object_trans' => $linkreport ?? null,
                            'default_tab' => 'general',
                            'form_fields' => [
                            ],
                            'translation_file' => 'admin_linkreport'
                        ])

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.linkreport.index")
                        ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>

    <div id="append-data" style="display: none">
        <div class="col-md-12">
            <div class="col-md-12 text-right">
                <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
            </div>

            <div class="col-md-4">
                <div class="font-bold col-green">{!! trans("admin_project.form.project") !!}</div>
                <select name="project_choose[]" class="project_choose form-control">
                    <option value="">Choose Project</option>
                    @if(isset($projects) && $projects->count() > 0)
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-4 rating-project">
                <div class="font-bold col-green">{!! trans("admin_project.form.estimated_rental_yield") !!}</div>
                <div class="form-group">
                    <input type="hidden" name="estimated_rental[]" class="rating" data-fractions="2" value=""/>
                </div>
            </div>

            <div class="col-md-4 rating-project">
                <div class="font-bold col-green">{!! trans("admin_project.form.estimated_capital_appreciation") !!}</div>
                <div class="form-group">
                    <input type="hidden" name="estimated_capital[]" class="rating" data-fractions="2" value=""/>
                </div>
            </div>
        </div>
    </div>
<style>
    .rating-project .glyphicon, .rating-project-edit .glyphicon{ font-size: 20px }
    .tab-nav-right li[role="presentation"]:last-child{ display: none; }
    .rating-project > div > span:first-child{ display: none; }
</style>
@endsection

@section("script")
    @include("admin.layouts.partials.modal-delete")

    <!--dataTables plugin-->
    <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-rating.min.js"></script>
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>
    <script type="text/javascript" src="/assets/admin/js/pages/linkreport.create.js?v=1"></script>
    <script>
        $('.rating').rating();
        $(document).on('click', '#btn-create-project', function(){
            $('#show-project').append($('#append-data').html());
            $('.rating').rating();
        });
        $(document).on('click','.button-remove', function(){
            $(this).parent().parent().remove();
        });
    </script>
@endsection
