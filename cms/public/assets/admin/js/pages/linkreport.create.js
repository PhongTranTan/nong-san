jQuery(function ($) {

    var validateRules = {
        'report_title': {
            required:true
        },
        'url': {
            required:true
        },
        'description': {
            required:true
        }
    };
    
    // for (let key in COMPOSER_LOCALES) {
    //     if(LOCALES_REQUIRE.indexOf(key) !== -1){
    //         validateRules[`${key}[name]`] = {required: true};
    //     }
    // }

    $('#form-form').validate({
        focusInvalid: true,
        ignore: "",
        highlight: function(element) {
            $(element).closest('.tab-pane').addClass("tab-error");
            $(element).addClass("input-error");
            var tab_content= $(element).closest('form');
            if($(".active.tab-error label.error").length == 0){
                var _id = $(tab_content).find(".tab-error:not(.active)").attr("id");
                $('a[href="#' + _id + '"]').tab('show');
            }

            $(element).parents('.form-line').addClass('error');
        },
        unhighlight: function(element) {
            $(element).closest('.tab-pane').removeClass("tab-error");
            $(element).removeClass("input-error");

            $(element).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        rules: validateRules
    });

	$(document).on('click', '.add-banner', function(){
        var banners = '<div class="col-md-4">';
        banners += '<button class="btn btn-danger pull-right button-remove-banner" type="button">Remove</button><br/>';
        banners += '<div class="font-bold col-green">Banner</div>';
        banners += '<div class="form-group">';
        banners += '<div class="ckfinder-upload">';
        banners += '<div class="out-image hidden">';
        banners += '<img src="">';
        banners += '<input type="hidden" value="" name="banner_images[]">';
        banners += '<div class="info-file"></div>';
        banners += '<button type="button" class="btn btn-danger btn-circle btn-delete">';
        banners += '<span class="glyphicon glyphicon-remove"></span>';
        banners += '</button>';
        banners += '</div>';
        banners += '<div class="box-upload ">';
        banners += '<label class="label-select">';
        banners += '<span class="glyphicon glyphicon-picture"></span>';
        banners += '</label>';
        banners += '<button type="button" class="btn-ckfinder"></button>';
        banners += '</div>';
        banners += '</div>';
        banners += '</div>';
        banners += '<div class="tab-content">';
        banners += '<div class="font-bold col-green">Title</div>';
        banners += '<div class="form-group form-float">';
	    banners += '<div class="form-line">';
	    banners += '<input type="text" class="form-control" name="banner_title[]" value="">'
	    banners += '</div>';
        banners += '</div>';
        banners += '<div class="font-bold col-green">Description</div>';
	    banners += '<div class="form-group form-float">';
	    banners += '<div class="form-line">';
	    banners += '<textarea class="form-control" name="banner_description[]" rows="4"></textarea>';
	    banners += '</div>';
        banners += '</div>';
        banners += '</div>';
        banners += '</div>';
        $("#load-banner").append(banners);
    });

    $(document).on('click','.button-remove-banner', function(){
        $(this).parent().remove();
    });

});