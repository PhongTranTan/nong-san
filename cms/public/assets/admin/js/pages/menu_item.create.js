jQuery(function ($) {

    $('.js-example-basic').select2();
    $('#parent_id').select2();

    var validateRules = {
        type: {
            required: true
        },
        'menu_id[]': {
            required: true
        }
    }

    for (let key in COMPOSER_LOCALES) {
        if (LOCALES_REQUIRE.indexOf(key) !== -1) {
            validateRules[`${key}[title]`] = {
                required: true
            };
        }
    }

    $('#form-form').validate({
        focusInvalid: true,
        ignore: "",
        highlight: function (element) {
            $(element).closest('.tab-pane').addClass("tab-error");
            $(element).addClass("input-error");
            var tab_content = $(element).closest('form');
            if ($(".active.tab-error label.error").length == 0) {
                var _id = $(tab_content).find(".tab-error:not(.active)").attr("id");
                $('a[href="#' + _id + '"]').tab('show');
            }

            $(element).parents('.form-line').addClass('error');
        },
        unhighlight: function (element) {
            $(element).closest('.tab-pane').removeClass("tab-error");
            $(element).removeClass("input-error");

            $(element).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        rules: validateRules
    });

    $(document).on('change', '#type', function() {
        let type = $(this).val();

        $.get(URL_GET_THEME, { type : type }, function (data) {
            if(data.status_code == 200) {
                $(".theme-link-ajax").html('');
                $(".theme-link").html('');

                for (let key in COMPOSER_LOCALES) {
                    $('#' + key + 'url').parents('.col-md-4').show(200);
                }
            } else {
                $(".theme-link-ajax").html('');
                $(".theme-link-ajax").html(data);
                $(".theme-link-ajax").show(200);

                for (let key in COMPOSER_LOCALES) {
                    $('#' + key + 'url').parents('.col-md-4').hide(200);
                }
            }
            
        });
    });

    $(document).on('change', '#parent_id', function () {
        var val = $(this).val();
        if(val != 0) {
            $('#layout_type').parents('.col-md-4').hide(200);
        } else {
            $('#layout_type').parents('.col-md-4').show(200);
        }
    });
});