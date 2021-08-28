var sortMenuItem = $('meta[name=linkSortMenuItem]').attr('content');

$(function () {

    var idSort = '.sortable-menu-item';

    $(idSort).sortable({
        placeholder: "sortable-placeholder",
        helper: 'clone',
        sort: function (e, ui) {
            position = Number($(idSort + " > li:visible").index(ui.placeholder));
            if (position == 0) position = 0;
            else position = position + 1;
            $(ui.placeholder).html("<div class='position-sort'> " + position + " </div>");
        },
        update: function (event, ui) {
            var position = "";
            $(idSort).children().each(function (i) {
                var li = $(this);
                position += "" + li.attr("data-id") + '=' + i + '&';
            });
            var str_lenght = position.length;
            str_lenght = str_lenght - 1;
            position = position.substring(0, str_lenght);
            $.ajax({
                type: "POST",
                url: sortMenuItem,
                data: {
                    position: position
                },
                success: function (data) {
                    console.log(position);
                }
            });
        },
        start: function (event, ui) {
            ui.item.startPos = ui.item.index();
        },
        stop: function (event, ui) {
            console.log("Start position: " + ui.item.startPos);
            console.log("New position: " + ui.item.index());
        }
    });

    $(".sortable-menu-item").disableSelection();
});