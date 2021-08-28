jQuery(function ($) {
    var linkGetBlock = $('meta[name=linkGetBlock]').attr('content');

    var validateRules = {
        theme: {required: true},
    }
    for (let key in COMPOSER_LOCALES) {
        if(LOCALES_REQUIRE.indexOf(key) !== -1){
            validateRules[`${key}[title]`] = {required: true};
        }
    }

    $('#btn_add_block').on('click', function () {
        let _this = $(this);
        let types = $('#block_type').val();
        $('#block_type').val(null);
        let error = _this.data('error');
        _this.prop('disabled', true);
        if (types && types.length) {
            $.get(linkGetBlock, {types: types}, function (res) {
                $('#block-modules').append(res);
                _this.prop('disabled', false);
            });
        }
        else {
            toastr["error"](error);
            _this.prop('disabled', false);
        }
        return false;
    });

    $('#form-form').validate({
        ignore: "",
        rules: validateRules,
        highlight: function (input) {
            $(input).closest('.tab-pane').addClass("tab-error");
            $(input).addClass("input-error");
            var tab_content = $(input).closest('form');
            if ($(".active.tab-error label.error").length == 0) {
                var _id = $(tab_content).find(".tab-error:not(.active)").attr("id");
                $('a[href="#' + _id + '"]').tab('show');
            }

            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).closest('.tab-pane').removeClass("tab-error");
            $(input).removeClass("input-error");

            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, input) {
            $(input).parents('.form-group').append(error);
        }
    });

    $('.module-item .btn-info').click(function () {
        let _this = $(this);
        let change = $(this).data('change');
        $(change).val(1);

        //option => disable sort table
        _this.closest('.module-item').toggleClass('disabled-sort');
    });

    /**
     * Sorttable
     * @type {string}
     * @private
     */
    let _elementSort = '#block-modules';
    let _elementSort2 = '#block-modules .module-item .module-items';

    $(_elementSort).sortable({
        placeholder: "sortable-placeholder",
        cancel: ".disabled-sort, .disabled-sortable",
        helper: 'clone',
        sort: function (e, ui) {
            let position = Number($(_elementSort + " > div:visible").index(ui.placeholder));
            position++;
            $(ui.placeholder).html("<div class='module-item' style='font-size: 20px; color: #fff; background-color: #00a651'> #" + position + " </div>");
        },
        update: function (event, ui) {
            $(_elementSort).children().each(function (i) {
                let el = $(this);
                // update position to input
                let el_position = el.data('el_position');
                $(`input[name='${el_position}']`).val(i);
                el.find('.position').html(i);

                // set module has changed
                let change = el.find('.btn-info').first().data('change');
                $(change).val(1);
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
    $(_elementSort2).sortable({
        placeholder: "sortable-placeholder",
        //cancel: ".disabled-sort, .disabled-sortable",
        helper: 'clone',
        sort: function (e, ui) {
            let position = Number($(_elementSort2 + " > div:visible").index(ui.placeholder));
            position++;
            $(ui.placeholder).html("<div class='module-item' style='font-size: 20px; color: #fff; background-color: #00a651'> #" + position + " </div>");
        },
        update: function (event, ui) {
            $(_elementSort2).children().each(function (i) {
                let el = $(this);
                // update position to input
                let el_position = el.data('el_position');
                $(`input[name='${el_position}']`).val(i);
                el.find('.position').html(i);

                // set module has changed
                let change = el.find('.btn-info').first().data('change');
                $(change).val(1);
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

    $(_elementSort).disableSelection();
    $(_elementSort2).disableSelection();
});