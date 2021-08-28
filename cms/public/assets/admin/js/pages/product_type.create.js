jQuery(function ($) {

    var validateRules = {

    };
    
    for (let key in COMPOSER_LOCALES) {
        if(LOCALES_REQUIRE.indexOf(key) !== -1){
            validateRules[`${key}[name]`] = {required: true};
        }

        $("#" + key + 'tag').tagsinput({
            'height': '100px',
            'width': '100%',
            'defaultText': 'Unit...',
            'placeholderColor': '#666666'
        });
    }

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

    $('.add-project-price').on('click', function(){
        $(".append-project-price-hidden").each(function(){
            var project_price = $("#plus-project-price").html();
            $("#project-price-more").append(project_price);
        });
    });

    $('.add-last-update').on('click', function(){
        $(".append-last-update-hidden").each(function(){
            var project_last_update = $("#plus-project-last-update").html();
            $("#project-last-update").append(project_last_update);
            $("#project-last-update").find('.datepicker').datepicker({ dateFormat: 'dd/mm/yy' });
        });
    });


    $(document).on('click', '.btn-add-images', function(){
        var gallery_number = $(this).data("add");
        var project_galleries = '<div class="col-md-4">';
        project_galleries += '<button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>';
        project_galleries += '<div class="font-bold col-green">Images</div>';
        project_galleries += '<div class="form-group">';
        project_galleries += '<div class="ckfinder-upload">';
        project_galleries += '<div class="out-image hidden">';
        project_galleries += '<img src="">';
        project_galleries += '<input type="hidden" value="" name="project_gallery['+gallery_number+'][]">';
        project_galleries += '<div class="info-file"></div>';
        project_galleries += '<button type="button" class="btn btn-danger btn-circle btn-delete">';
        project_galleries += '<span class="glyphicon glyphicon-remove"></span>';
        project_galleries += '</button>';
        project_galleries += '</div>';
        project_galleries += '<div class="box-upload ">';
        project_galleries += '<label class="label-select">';
        project_galleries += '<span class="glyphicon glyphicon-picture"></span>';
        project_galleries += '</label>';
        project_galleries += '<button type="button" class="btn-ckfinder"></button>';
        project_galleries += '</div>';
        project_galleries += '</div>';
        project_galleries += '</div>';
        project_galleries += '</div>';
        project_galleries += '</div>';
        $("#section-gallery"+gallery_number).append(project_galleries);
    });

    $('#btn-create-gallery').on('click', function(){
        var btn_gallery_number = $(this).data("gallery-add");
        var html_gallery = '<div class="col-md-3">';
        html_gallery += '<div id="gallery-'+btn_gallery_number+'">';
        html_gallery += '<button class="button-remove-gallery" type="button"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></button>';
        html_gallery += '<button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#modalGallery'+btn_gallery_number+'">Open Gallery '+parseInt(btn_gallery_number)+'</button>';
        html_gallery += '<div class="modal fade" id="modalGallery'+btn_gallery_number+'" role="dialog">';
        html_gallery += '<div class="modal-dialog">';
        html_gallery += '<div class="modal-content">';
        html_gallery += '<div class="modal-header">';
        html_gallery += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        html_gallery += '<h4 class="modal-title text-center">Gallery '+parseInt(btn_gallery_number)+'</h4>';
        html_gallery += '</div>';
        html_gallery += '<div class="modal-body">';
        html_gallery += '<div class="col-md-6">';
        html_gallery += '<div class="font-bold col-green">Position</div>';
        html_gallery += '<div class="form-group form-float">';
        html_gallery += '<div class="form-line">';
        html_gallery += '<input type="text" class="form-control" name="gallery_position['+btn_gallery_number+']" autocomplete="off" value="0">';
        html_gallery += '</div>';
        html_gallery += '</div>';
        html_gallery += '</div>';
        html_gallery += '<div class="clearfix"></div>';
        html_gallery += '<div class="col-md-12">';
        html_gallery += '<button class="btn btn-primary pull-right btn-add-images" type="button" data-add="'+btn_gallery_number+'">Add Images</button>';
        html_gallery += '</div>';
        html_gallery += '<div class="clearfix"></div>';
        html_gallery += '<div class="col-md-12" id="section-gallery'+btn_gallery_number+'">';
        html_gallery += '<div class="col-md-4">';
        html_gallery += '<button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>';
        html_gallery += '<div class="font-bold col-green">Images</div>';
        html_gallery += '<div class="form-group">';
        html_gallery += '<div class="ckfinder-upload">';
        html_gallery += '<div class="out-image hidden">';
        html_gallery += '<img src="">';
        html_gallery += '<input type="hidden" value="" name="project_gallery['+btn_gallery_number+'][]">';
        html_gallery += '<div class="info-file"></div>';
        html_gallery += '<button type="button" class="btn btn-danger btn-circle btn-delete">';
        html_gallery += '<span class="glyphicon glyphicon-remove"></span>';
        html_gallery += '</button>';
        html_gallery += '</div>';
        html_gallery += '<div class="box-upload ">';
        html_gallery += '<label class="label-select">';
        html_gallery += '<span class="glyphicon glyphicon-picture"></span>';
        html_gallery += '</label>';
        html_gallery += '<button type="button" class="btn-ckfinder"></button>';
        html_gallery += '</div>';
        html_gallery += '</div>';          
        html_gallery += '</div>';
        html_gallery += '</div>';
        html_gallery += '</div>';
        html_gallery += '<div class="clearfix"></div>';
        html_gallery += '</div>';
        html_gallery += '</div>';
        html_gallery += '</div>';
        html_gallery += '</div>';
        html_gallery += '</div>';
        html_gallery += '</div>';
        $(this).data("gallery-add", parseInt(btn_gallery_number + 1))
        $("#show-gallery").append(html_gallery);
    })

    $('.add-project-slides').on('click', function(){
        $(".append-project-slides-hidden").each(function(){
            var project_slides = $("#plus-project-slides").html();
            $("#project-slides-more").append(project_slides);
        });
    });

    var i = 1;
    var languages = LANGUAGES;
    $('.add-project-floor').on('click', function(){
        $(".append-project-floor-hidden").each(function(){
            var project_floor = $("#plus-project-floor").html();
            $("#project-floor-more").append(project_floor);
        });
        for(var j = 0; j < languages.length; j++){
            $("#plus-project-floor").find(".ck-content-"+languages[j]).attr('id', languages[j]+'_floor_content'+i);
            $("#plus-project-floor").find(".ck-unit-"+languages[j]).attr('id', languages[j]+'_floor_unit'+i);
        }
        $("#project-floor-more textarea.ck").each(function () {
            if (!$(this).hasClass('ckeditor')) {
                installCkeditorCustom(this);
                $(this).addClass('ckeditor');
            }
        });
        i++;
    });

    $('#form-form').on('click', '.button-remove', function(){
        $(this).parent().remove();
    });

    $(document).on('click', '.button-remove-gallery', function(){
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.button-remove-update', function(){
        $(this).parent().remove();
    });
});