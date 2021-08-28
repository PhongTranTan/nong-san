@extends("admin.layouts.master")

@section("meta")
    <meta name="linkDatatable" content="{{ route('admin.subscribe.datatable') }}"/>
@endsection

@section("style")
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {!! trans("admin_subscribe.list") !!}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="body">
                    @include("admin.layouts.partials.message")
                    <table id="datatable" class="table table-bordered table-striped table-hover dataTable"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th width="40">{!! trans("admin_contact.table.id") !!}</th>
                            <th>{!! trans("admin_contact.table.name") !!}</th>
                            <th>{!! trans("admin_contact.table.phone") !!}</th>
                            <th>{!! trans("admin_contact.table.email") !!}</th>
                            <th>{!! trans("admin_customer.table.active") !!}</th>
                            <th>{!! trans("admin_contact.table.created_at") !!}</th>
                            <th width="150">{!! trans("admin_contact.table.action") !!}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("admin.layouts.partials.modal-delete")

    <!--dataTables plugin-->
    <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"
            type="text/javascript"></script>

    <script type="text/javascript" src="/assets/admin/js/pages/subscribe.index.js?v=1"></script>

    <script>
    jQuery(function ($) {
		$('#datatable tbody').on('click', '.btn-update', function () {
			var html = $(this);
    		var data = html.attr("data-row");
			$.ajax({
		        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		        type:'POST',
		        url: '{{ route('subscribe.status') }}',
		        data: {id: data},
		        dataType: 'text',
		        success:function(reponses){
		        	var label = html.parent().parent().find('.label-status');
		        	if(reponses == 1){
		        		var status = 'label-success';
		        		var text = 'Subscribe';
		        	}else{
		        		var status = 'label-warning';
		        		var text = 'Unsubscribe';
		        	}
		        	label.removeClass('label-success');
		        	label.removeClass('label-warning');
		        	label.addClass(status);
		        	label.html(text);
		        },
		        error:function(reponses) {

			    }
		    });
		});
	});
    </script>
@endsection