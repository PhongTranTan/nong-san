jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    var _table = $("#datatable");

    var datatable = _table.DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200,-1], [10, 25, 100, 200, "All"]],
        pageLength: 10,
        ajax: {
            url: linkDatatable,
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'fullname', name: 'fullname', orderable: false},
            {data: 'phone', name: 'phone', orderable: false},
            {data: 'type', name: 'type', orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/'+COMPOSER_LOCALE+'.json'
        }
    });

    // Add event listener for opening and closing details
    $('#datatable tbody').on('click', '.btn-detail', function () {
        var template = $("#details-template").html();

        var tr = $(this).closest('tr');
        var row = datatable.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            if(row.data().message !== ''){
                template = template.replace('CONTACT_MESSAGE', '<p><strong>Message: </strong></p> <p>'+row.data().message.replace(/\r\n|\n|\r/g, '<br/>')+'</p>');
            }else{
                template = template.replace('CONTACT_MESSAGE', '');
            }
            if(row.data().email !== ''){
                template = template.replace('EMAIL', '<p><strong>Email: </strong>'+row.data().email+'</p>');
            }else{
                template = template.replace('EMAIL', '');
            }
            if(row.data().date !== '' && row.data().time !== ''){
                template = template.replace('DATE_TIME', '<p><strong>Date Time: </strong>'+row.data().date+' '+row.data().time+'</p>');
            }else{
                template = template.replace('DATE_TIME', '');
            }
            if(row.data().number_of_rooms !== ''){
                template = template.replace('NUMBER_ROOMS', '<p><strong>Number of Rooms: </strong>'+row.data().number_of_rooms+'</p>');
            }else{
                template = template.replace('NUMBER_ROOMS', '');
            }
            if(row.data().property !== ''){
                template = template.replace('PROPERTY', '<p><strong>Property: </strong></p> <p>'+row.data().property.replace(/\r\n|\n|\r/g, '<br/>')+'</p>');
            }else{
                template = template.replace('PROPERTY', '');
            }
            if(row.data().budget !== ''){
                template = template.replace('BUDGET', '<p><strong>Budget: </strong>'+row.data().budget+'</p>');
            }else{
                template = template.replace('BUDGET', '');
            }
            if(row.data().project_id !== ''){
                template = template.replace('PROJECT', '<p><strong>Project: </strong></p> <p>'+row.data().project_id.replace(/\r\n|\n|\r/g, '<br/>')+'</p>');
            }else{
                template = template.replace('PROJECT', '');
            }
            if(row.data().agree !== ''){
                template = template.replace('AGREE', '<p><strong>Please arrange for transportation to showflat :</strong> Yes</p>');
            }else{
                template = template.replace('AGREE', '');
            }
            // Open this row
            row.child( template ).show();
            tr.addClass('shown');
        }
    });
});