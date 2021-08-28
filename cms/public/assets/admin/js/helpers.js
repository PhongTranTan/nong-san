function googleAutoComplete(output, callback) {
    var input = document.getElementById(output['elementId']);
    var autocomplete = new google.maps.places.Autocomplete(input);

    if (typeof output['options'] != 'undefined' && output['options']) {
        autocomplete.setComponentRestrictions(output['options']);
    }
    else {
        var autocomplete = new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        setTimeout(function () {
            fillInAddress(place, callback)
        }, 300);
    });
}

function fillInAddress(place, callback) {
    var data = {
        street_number: null, //Sô nhà
        route: null, //Đường
        sublocality_level_1: null, //Phường
        locality: null, //Đia bàn
        administrative_area_level_2: null,//Quận
        post_code: null,
        administrative_area_level_1: null, //Thanh pho
        country: null, //Nuoc
        lat: null,
        lng: null,
        address: null,
        zoom: 6
    };
    if (typeof place.geometry != "undefined") {

        data.lat = place.geometry.location.lat();
        data.lng = place.geometry.location.lng();
        data.address = place.formatted_address;

        var fill = [
            'street_number',
            'route',
            "locality",
            'sublocality_level_1',
            'administrative_area_level_2',
            'administrative_area_level_1',
            'post_code',
            'country'
        ];
        var address_components = place.address_components;

        for (var i = 0; i < address_components.length; i++) {
            if (
                typeof address_components[i]['types'][0] != 'undefined'
                && typeof data[address_components[i]['types'][0]] != 'undefined'
                && fill.indexOf[address_components[i]['types'][0]] != -1
            ) {
                data[address_components[i]['types'][0]] = address_components[i]['long_name'];
            }
        }

        if (data.country) {
            data.zoom = 5;
        }
        if (data.administrative_area_level_1) {
            data.zoom = 10;
        }
        if (data.locality || data.administrative_area_level_2) {
            data.zoom = 11;
        }
        if (data.sublocality_level_1) {
            data.zoom = 12;
        }
        if (data.route) {
            data.zoom = 13;
        }
        if (data.street_number) {
            data.zoom = 14;
        }
    }
    if (typeof callback === "function") {
        setTimeout(function () {
            callback(data);
        }, 200);
    }
    return data;
}

/**
 * Get location from json google
 * @param url
 * @param callback
 */
function getJsonLocationFromGoogle(url, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callback(JSON.parse(this.responseText));
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

function allowType(types, type) {
    types = types.split("|");
    var result = new Array();
    if (types.indexOf(type) == -1) {
        var str = 'Support file type: ' + types.join(", ");
        result[0] = false;
        result[1] = str;
        return result;
    } else {
        result[0] = true;
        result[1] = 'success';
        return result;
    }
}

function allowSize(max_size, size) {
    max_size = parseInt(max_size);
    var result = new Array();
    if (size > max_size) {
        var str = 'The file size must less than ' + Math.round(max_size / 1024) + ' KB';
        result[0] = false;
        result[1] = str;
        return result;
    } else {
        result[0] = true;
        result[1] = 'success';
        return result;
    }
}

//Ham doc file image
function encodeImageFileAsURL(file, option) {
    if (!option.ext || (option.ext && option.ext !== 'mp4')) {
        var reader = new FileReader();
        reader.onloadend = function () {
            setTimeout(function () {
                if (typeof  window[option.callback] === "function") {
                    window[option.callback](reader.result, option);
                }
                else {
                    console.log("Can not call callback function!");
                }
            }, 200);
        }
        reader.readAsDataURL(file);
    }
    else {
        if (typeof window[option.callback] === "function") {
            window[option.callback](option.image_default, option);
        }
        else {
            console.log("Can not call callback function!");
        }
    }
}

function callbackHandlePhoto(file, option) {
    var theme = $(option.template).html();
    theme = theme.replace("IMAGE_BASE64", file)
        .replace("INPUT_NAME", option.name)
        .replace("FILE_NAME", option.filename)
        .replace("FILE_SIZE", option.filesize)
        .replace("INPUT_VALUE", file);

    $(option.append).find(".out-image").remove();
    $(option.append).prepend(theme);
    $(option.append).find(".box-upload").hide();
}

function callbackHandlePhotos(value, option) {
    var theme = $(option.template).html();
    theme = theme.replace("IMAGE_BASE64", value)
        .replace("INPUT_NAME", option.name)
        .replace("INPUT_VALUE", value);

    $(option.append).append(theme);
    return false;
}

function installCkeditor(input_id) {
    let optionsCkfinder = {
        filebrowserBrowseUrl: '/assets/plugins/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '/assets/plugins/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '/assets/plugins/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    };

    let yeuhoa = CKEDITOR.replace(input_id, optionsCkfinder);
    CKFinder.setupCKEditor(yeuhoa, '../');
}

function installAce(input_id) {
    let textarea = $('#' + input_id);
    let editor = ace.edit('ace_' + input_id);
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/html");
    editor.getSession().on('change', function () {
        textarea.val(editor.getSession().getValue());
    });
}

jQuery(function ($) {
    $("body").on("keypress keydown", ".noEnterSubmit", function (event) {
        if (event.which == 13) {
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
    });

    $("body").on("change", ".input-position", function (e) {
        e.preventDefault();
        var _this = $(this);
        var href = _this.data("href");
        var position = _this.val();
        var data = {
            position: position
        };
        $.ajax({
            data: data,
            type: "PUT",
            url: href,
            beforeSend: function () {
                _this.prop("readonly", true);
            }
        }).done(function () {
            _this.prop("readonly", false);
            _this.closest(".sort-position").find(".icon-ok").removeClass("hidden");
        });
    });

    $("body").on("change", ".dz_select_photos", function (event) {
        event.stopPropagation();
        event.preventDefault();

        var _this = $(this);
        var files = event.target.files;
        var append = _this.data("append");
        var name = _this.data("name");
        var template = _this.data("template");
        var callback = _this.data("callback");
        var max_size = _this.data("max_size");
        max_size = max_size ? Number(max_size) : MAX_IMAGE_UPLOAD_SIZE;
        var mime_type = _this.data("mime_type");
        mime_type = mime_type ? mime_type : IMAGE_TYPE_ACCEPT;

        var file_type = _this.data("file_type");
        file_type = file_type ? file_type : 'base_64';

        var image_default = _this.data("image_default");
        image_default = image_default ? image_default : IMAGE_DEFAULT_VIDEO;


        // Create a formdata object and add the files
        $.each(files, function (key, value) {
            var random = Math.random().toString(36).slice(2);
            var filesize = value.size;
            var filename = value.name;
            var ext = filename.split('.').pop();
            ext = ext.toLowerCase();
            //Check size
            var check = allowSize(max_size, filesize);
            if (!check[0]) {
                _this.val(null);
                toastr["warning"](check[1]);
                return false;
            }
            //Check extensions
            check = allowType(mime_type, ext);
            if (!check[0]) {
                _this.val(null);
                toastr["warning"](check[1]);
                return false;
            }
            var option = {
                random: random,
                name: name,
                filesize: parseFloat(filesize / 1024 / 1024).toFixed(2),
                filename: filename,
                append: append,
                template: template,
                callback: callback,
                image_default: image_default,
                ext: ext
            };
            encodeImageFileAsURL(value, option);
        });

        if (file_type == 'base_64') {
            _this.val(null);
        }
        return false;
    });

    $("body").on("click", ".btn_delete_this", function (event) {
        event.stopPropagation();
        event.preventDefault();
        var _this = $(this);
        var name = _this.data("name");
        var value = _this.data("value");
        var parent = _this.data("parent");
        var _closest = _this.closest(parent);

        if (name && value) {
            _this.closest("form").append("<input type='hidden' name=" + name + " value='" + value + "'>");
        }

        _closest.animate({
            opacity: 0,
        }, 300, function () {
            _closest.remove();
        });
        return false;
    });

    $("body").on("change", ".basic_upload_file", function (event) {
        event.stopPropagation();
        event.preventDefault();
        var _this = $(this);
        var accept_type = $(this).attr("accept_type");
        var name = this.files && this.files.length ? this.files[0].name : '';
        var size = name ? parseFloat(this.files[0].size / 1024) : null;
        // Check size upload
        if (size) {
            if (accept_type == "image") {
                var max_size = _this.data("max_size");
                max_size = max_size ? Number(max_size) : MAX_IMAGE_UPLOAD_SIZE;
                var check = allowSize(max_size, size);
                if (!check[0]) {
                    $(this).val(null);
                    toastr["warning"](check[1]);
                    return false;
                }
            }
            else if (accept_type == "file") {
                var max_size = _this.data("max_size");
                max_size = max_size ? Number(max_size) : MAX_FILE_UPLOAD_SIZE;
                var check = allowSize(max_size, size);
                if (!check[0]) {
                    $(this).val(null);
                    toastr["warning"](check[1]);
                    return false;
                }
            }
        }
        if (name) {
            name = name + "(" + size.toFixed(2) + " KB)";
        }
        $(this).closest('.wrap-input-file').find('.upload-file-info').html(name);
    })

    $('body').on('change', '.checkbox-tick-all', function (event) {
        event.stopPropagation();
        event.preventDefault();
        var _this = $(this);
        var parent = _this.data('parent');
        var _parent = _this.closest(parent);
        if (_this.is(':checked')) {
            _parent.find('input[type=checkbox]').prop('checked', true);
        }
        else {
            _parent.find('input[type=checkbox]').prop('checked', false);
        }
    });

    $(document).on('submit', 'form', function() {
        var $form = $(this),
            $button;
        $form.find(':submit').each(function() {
            $button = $(this);
            $button.prop('disabled', true);
        });
    });

    $(document).on('keypress keydown', ".no_enter_submit input[type=text]", function (event) {
        if (event.which == 13) {
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
    });

    $('body').on('click', '.ckfinder-upload .btn-ckfinder', function (event) {
        event.preventDefault();
        var _this = $(this);
        var closest = _this.closest('.ckfinder-upload');
        var image = closest.find('img');
        var input = closest.find('input');
        var info = closest.find('.info-file');
        var out_image = closest.find('.out-image');
        var box_upload = closest.find('.box-upload');

        CKFinder.popup({
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function (finder) {
                finder.on('files:choose', function (evt) {
                    var file = evt.data.files.first();
                    var path = file.getUrl();
                    var filename = path.substring(path.lastIndexOf('/') + 1);
                    image.attr('src', path);
                    input.val(path);
                    info.html(filename);
                    out_image.removeClass('hidden');
                    box_upload.addClass('hidden');
                });

                finder.on('file:choose:resizedImage', function (evt) {
                    var path = evt.data.resizedUrl;
                    var filename = path.substring(path.lastIndexOf('/') + 1);
                    image.attr('src', path);
                    input.val(path);
                    info.html(filename);
                    out_image.removeClass('hidden');
                    box_upload.addClass('hidden');
                });
            }
        });
    });

    $('body').on('click', '.btn_select_a_file', function (event) {
        event.preventDefault();
        let _this = $(this);
        let append = _this.data('append');
        CKFinder.popup({
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function (finder) {
                finder.on('files:choose', function (evt) {
                    var file = evt.data.files.first();
                    var path = file.getUrl();
                    $(append).val(path);

                });

                finder.on('file:choose:resizedImage', function (evt) {
                    var path = evt.data.resizedUrl;
                    $(append).val(path);
                });
            }
        });
    });

    $('body').on('click', '.ckfinder-upload .btn-delete', function (event){
        event.preventDefault();
        var _this = $(this);
        var closest = _this.closest('.ckfinder-upload');
        var image = closest.find('img');
        var input = closest.find('input');
        var info = closest.find('.info-file');
        var out_image = closest.find('.out-image');
        var box_upload = closest.find('.box-upload');

        image.removeAttr('src');
        input.val('');
        info.html('');
        out_image.addClass('hidden');
        box_upload.removeClass('hidden');
    });

    $('body').on('click', '.ckfinder-multi', function (event) {
        event.preventDefault();
        var _this = $(this);
        var _append = _this.data('append');
        var ext = _this.data('ext');
        var arr_ext = ext ? ext.split('|') : ['jpg', 'jpeg', 'png', 'gif'];
        var _name= _this.data('name');
        var temp = '<li class="disable-sort-item">'+
            '                                <div class="box-image">'+
            '                                    <img src="IMAGE_PATH" />'+
            '                                    <button type="button"'+
            '                                            class="btn_delete_this"'+
            '                                            data-parent="li"'+
            '                                            data-multi="1">'+
            '                                        <i class="glyphicon glyphicon-remove"></i>'+
            '                                    </button>'+
            '                                </div>'+
            '                                <input type="hidden" name="'+_name+'" value="IMAGE_PATH">'+
            '                            </li>';


        CKFinder.popup({
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function (finder) {
                finder.on('files:choose', function (evt) {
                    if(evt.data.files.length){
                        for (var i = 0, len = evt.data.files.models.length; i < len; i++) {
                            let path = evt.data.files.models[i].attributes.url;
                            let name = evt.data.files.models[i].attributes.name;
                            $(_append).append(temp.replace(/IMAGE_PATH/g, path));
                        }
                    }

                    /*
                    var file = evt.data.files.first();
                    var path = file.getUrl();
                    var filename = path.substring(path.lastIndexOf('/') + 1);
                    $(_append).append(temp.replace(/IMAGE_PATH/g, path));
                    */
                });

                finder.on('file:choose:resizedImage', function (evt) {

                    var path = evt.data.resizedUrl;
                    var filename = path.substring(path.lastIndexOf('/') + 1);
                    $(_append).append(temp.replace(/IMAGE_PATH/g, path));
                });
            }
        });

        return false;
    });
});
