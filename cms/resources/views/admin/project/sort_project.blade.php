@extends("admin.layouts.master")

@section("meta")
    <meta name="linkDatatable" content="{{ route('admin.project.datatable') }}"/>
@endsection

@section("style")
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
    <style>
        .item {
            transition: flex-basis ease 200ms, margin ease, 200ms;
        }

        .ul-custom {
            border: 1px solid #a0ce4e;
        }

        .item-active {
            background: #f3eeee;
        }

        .text-position {
            padding: 5px;
            background-color: #a0ce4e;
            color: black;
            height: 30px !important;
            width: 30px !important;
            font-weight: bold;
            border: 1px solid #fff;
        }
    </style>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Sort Project
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="body">
                    @include("admin.layouts.partials.message")
                    <form id="form-form" method="POST"
                        action="{{ route('project.sort.update') }}"
                        enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="put">
                    {{ csrf_field() }}
                    <div style="text-align: center">
                        <button class="btn btn-success" type="submit">
                            <i class="material-icons">edit_note</i>
                            Update Display Order
                        </button>

                    </div>
                    <p></p>
                    <ul class="list-group ul-custom" id="sortable">
                        @foreach($projects as $key => $project)
                            <li class="list-group-item item" 
                                data-display="{{ $project->position }}"
                            >
                                <span class="text-position">{{ $project->position }}</span>
                                <span >{{ "{$project->name}" }}</span>
                                <input class="item-display-order" 
                                    type="hidden" 
                                    value="{{ $project->position }}" 
                                    name="positions[{{ $project->id }}][position]">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        function sortList($template, $box)
        {
            let listDashed = $($template).find($box);
            if (listDashed.length > 0) {
                $.each(listDashed, function (index, value) {
                    $(value).attr('data-display', index);
                    let itemSort = $(value).find('.item-display-order');
                    let textPosition = $(value).find('.text-position');
                    itemSort.val(index);
                    textPosition.html(index);
                });
            }
        }

        function updatePosition()
        {
            $( "#sortable" ).sortable({
                update: function (event, ui) {
                    sortList('.list-group', '.item');
                }
            });    
            $( "#sortable" ).disableSelection();
        }

        function activeItemMove()
        {
            $('#sortable').on('click', '.list-group-item', function() {
                $('#sortable').children().removeClass('item-active');
                $(this).toggleClass('item-active');
            })

            $('.list-group-item').hover(function() {
                $('#sortable').children().removeClass('item-active');
                $(this).toggleClass('item-active');
            });
        }

        $( function() {
            activeItemMove();
            updatePosition();
        });
    </script>
@endsection