jQuery(function ($) {
    $('#form-form').validate({
        rules: {
            'contact_email': {
                required: true,
                email: true
            },
            'day_update_job_status': {
                required: true,
                number: true,
                min: 1,
                max: 100
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
});