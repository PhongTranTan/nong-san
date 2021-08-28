<!DOCTYPE html>
<html lang="{{ $composer_locale }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <base href="{{ url('') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="">
    <meta property="og:type" content="website">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta property="twitter:image" content="">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="fb:app_id" content="">
    <meta name="twitter:site" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/images/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/images/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/images/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/images/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/images/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/images/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/images/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/images/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icons/favicon-16x16.png">
    <link rel="shortcut icon" href="/assets/images/icons/favicon.ico">
    <link rel="manifest" href="/assets/manifest.json">
    <meta name="msapplication-TileColor" content="#f05b28">
    <meta name="msapplication-TileImage" content="/assets/images/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#f05b28">
    @include('frontend.layouts.partials.seo')
    
    @stack('style')

    {!! isset($arr_setting['google_analytic']) ? $arr_setting['google_analytic'] : NULL !!}
</head>

<body class="@yield('class-home')">
<div id="page">
@include('frontend.layouts.partials.header')

@yield('content')

<footer class="@yield('footer-page')">  
    @yield('footer')
    @yield('button-bottom')

    <div class="back-top" id="gotoTopMain"><span><i class="icon icon-to-top"></i></span></div>
</footer>

</div>

<script type="text/javascript" src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery-cookie.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}" type="text/javascript"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}'
        }
    });
</script>

<!--Cookies Like Project-->

<script>

    jQuery(document).ready(function ($) {
        $('.count-check-like').text(0);
        var d = new Date();
        var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
        var expires = new Date(strDate.replace(' ', 'T'));
        expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000));
        var count_favorite = 0;
        var favorite = [];
        var cookie = $.cookie("project");
        if($.cookie("project") !== undefined && $.cookie("project") !== null){
            favorite = JSON.parse($.cookie("project"));
            count_favorite = favorite.length;
            if(count_favorite > 0){
                $(".empty-noti").addClass("d-none");
                $(".content-fav .group-btn").removeClass("d-none");
                //$(".simplebar-placeholder").css({"min-height":+parseInt(count_favorite * 134)+"px"});
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:'POST',
                    url: '{{ route('get.favorite') }}',
                    data: {
                        favorite: $.cookie("project")
                    },
                    dataType: 'json',
                    success:function(reponses){
                        $.each(reponses, function(index, element) {
                            var project_id = element.id;
                            var images = element.project_slides;
                            var first_image = '';
                            if(images != ''){
                                var first_image = JSON.parse(images)[0];
                            }
                            var name = element.name;
                            var district_name = element.district_name;
                            var tenure_name = element.tenure_name;
                            var project_slug = element.slug;
                            var link = '{{ route('frontend.project.detail', ['slug' => ':slug']) }}';
                            link = link.replace(':slug', project_slug);
                            var html_favorite = '<div class="fav-line" data-favorite="'+project_id+'">';
                            html_favorite += '<div class="fav-line-left">';
                            html_favorite += '<div class="img-bg" style="background-image:url('+first_image+')"><img src="'+first_image+'" alt="'+name+'"></div>';
                            html_favorite += '</div>';
                            html_favorite += '<div class="fav-line-right"> <a class="title" href="'+link+'">'+name+'</a>';
                            html_favorite += '<div class="info"><span>'+district_name+'</span><span>'+tenure_name+'</span>';
                            html_favorite += '<input class="check-fav-line-'+project_id+' check-project" data-check="'+project_id+'" type="checkbox" name="check" id="checkedmodal'+project_id+'">';
                            html_favorite += '<label for="checkedmodal'+project_id+'"> </label>';
                            html_favorite += '</div></div>';
                            html_favorite += '<div class="btn-close-modal-item added" data-project="'+project_id+'"> </div></div>';
                            $(".simple-bar").append(html_favorite);
                            var html_showflat = '<div class="fav-line swiper-slide" data-favorite="'+project_id+'">';
                            html_showflat += '<div class="fav-line-left">';
                            html_showflat += '<div class="img-bg" style="background-image:url('+first_image+')"><img src="'+first_image+'" alt="'+name+'"></div>';
                            html_showflat += '</div>';
                            html_showflat += '<div class="fav-line-right"> <a class="title" href="'+link+'">'+name+'</a>';
                            html_showflat += '<div class="info"><span>'+district_name+'</span><span>'+tenure_name+'</span>';
                            html_showflat += '<input class="check-fav-line-'+project_id+' check-project" data-check="'+project_id+'" type="checkbox" name="check" id="checkedmodal'+project_id+'">';
                            html_showflat += '<label for="checkedmodal'+project_id+'"> </label>';
                            html_showflat += '</div></div>';
                            html_showflat += '<div class="btn-close-modal-item added" data-project="'+project_id+'"> </div></div>';
                            $("#simple-bar-showflat").append(html_showflat);
                        });
                    }
                });
            }else{
                $(".empty-noti").removeClass("d-none");
                $(".content-fav .group-btn").addClass("d-none");
                $(".simplebar-placeholder").css({"min-height":"121px"});
            }

        }
        $('.count-like').text(count_favorite);
        $('.li-heart').attr("data-total", count_favorite);
        var project = favorite;
        $(".btn-like").each(function(element, item){
            if(jQuery.inArray($(item).data('project').toString(), favorite) !== -1 ){
                $(item).addClass('added');
            }else{
                $(item).removeClass('added');
            }
        });
        $(".heart-like").each(function(element, item){
            if(jQuery.inArray($(item).data('project').toString(), favorite) !== -1 ){
                $(item).addClass('liked');
            }else{
                $(item).removeClass('liked');
            }
        });
        $(".btn-favorite").each(function(element, item){
            if(jQuery.inArray($(item).data('project').toString(), favorite) !== -1 ){
                $(item).addClass('added');
            }else{
                $(item).removeClass('added');
            }
        });

        $("body").on('click', '.btn-like, .heart-like', function(){;
            var data_project = $(this).attr("data-project");
            var test = $(this).hasClass('btn-like') ? true : false;
            if($(this).hasClass('added') || $(this).hasClass('liked') === test ){
                var count_favorite = 0;
                if($.cookie("project") !== undefined && $.cookie("project") !== null){
                    favorite = JSON.parse($.cookie("project"));
                }else{
                    favorite = [];
                }
                var project = favorite;
                count_favorite = favorite.length;
                $(this).removeClass('added');
                $(".li-heart").removeClass("run-shake").stop().addClass("run-shake");
                setTimeout(function () {
                    $(".li-heart").removeClass("run-shake");
                }, 700);
                $(".btn-favorite").removeClass("added");
                project = $.grep(project, function(value){
                    $(this).removeClass('added');
                    return (value != data_project && value);
                });
                if(count_favorite > 0){
                    count_favorite--;
                }
            
                $('.fav-line').filter(function(){
                    return $(this).data('favorite') == data_project
                }).remove();
            } else{
                if($.cookie("project") !== undefined && $.cookie("project") !== null){
                    favorite = JSON.parse($.cookie("project"));
                }else{
                    favorite = [];
                }
                var project = favorite;
                count_favorite = favorite.length;
                $(".li-heart").removeClass("run-popout").stop().addClass("run-popout");
                setTimeout(function () {
                    $(".li-heart").removeClass("run-popout");
                }, 700); 
                $('.content-fav .group-btn').removeClass('d-none');
                project.push(data_project);
                count_favorite++;
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:'POST',
                    url: '{{ route('add.favorite') }}',
                    data: {
                        add_favorite: data_project
                    },
                    dataType: 'json',
                    success:function(reponses){
                        $.each(reponses, function(index, element) {
                            var project_id = element.id;
                            var images = element.project_slides;
                            var first_image = '';
                            if(images != ''){
                                var first_image = JSON.parse(images)[0];
                            }
                            var name = element.name;
                            var district_name = element.district_name;
                            var tenure_name = element.tenure_name;
                            var project_slug = element.slug;
                            var link = '{{ route('frontend.project.detail', ['slug' => ':slug']) }}';
                            link = link.replace(':slug', project_slug);
                            var html_favorite = '<div class="fav-line" data-favorite="'+project_id+'">';
                            html_favorite += '<div class="fav-line-left">';
                            html_favorite += '<div class="img-bg" style="background-image:url('+first_image+')"><img src="'+first_image+'" alt="'+name+'"></div>';
                            html_favorite += '</div>';
                            html_favorite += '<div class="fav-line-right"> <a class="title" href="'+link+'">'+name+'</a>';
                            html_favorite += '<div class="info"><span>'+district_name+'</span><span>'+tenure_name+'</span>';
                            html_favorite += '<input class="check-fav-line-'+project_id+' check-project" data-check="'+project_id+'" type="checkbox" name="check" id="checkedmodal'+project_id+'">';
                            html_favorite += '<label for="checkedmodal'+project_id+'"> </label>';
                            html_favorite += '</div></div>';
                            html_favorite += '<div class="btn-close-modal-item added" data-project="'+project_id+'"> </div></div>';
                            $(".simple-bar").append(html_favorite);
                            var html_showflat = '<div class="fav-line swiper-slide" data-favorite="'+project_id+'">';
                            html_showflat += '<div class="fav-line-left">';
                            html_showflat += '<div class="img-bg" style="background-image:url('+first_image+')"><img src="'+first_image+'" alt="'+name+'"></div>';
                            html_showflat += '</div>';
                            html_showflat += '<div class="fav-line-right"> <a class="title" href="'+link+'">'+name+'</a>';
                            html_showflat += '<div class="info"><span>'+district_name+'</span><span>'+tenure_name+'</span>';
                            html_showflat += '<input class="check-fav-line-'+project_id+' check-project" data-check="'+project_id+'" type="checkbox" name="check" id="checkedmodal'+project_id+'">';
                            html_showflat += '<label for="checkedmodal'+project_id+'"> </label>';
                            html_showflat += '</div></div>';
                            html_showflat += '<div class="btn-close-modal-item added" data-project="'+project_id+'"> </div></div>';
                            $("#simple-bar-showflat").append(html_showflat);
                            $(".btn-like[data-project='"+data_project+"']").addClass("added");
                            $(".btn-favorite[data-project='"+project_id+"']").addClass("added");
                        });
                    }
                });
            }
            $(".simplebar-placeholder").css({"min-height":+parseInt(count_favorite * 134)+"px"});
            $('.count-like').text(count_favorite);
            $('.li-heart').attr("data-total", count_favorite);
            var data = JSON.stringify(project);
            $.cookie("project", data, { expires: expires });
            if(count_favorite > 0){
                $(".empty-noti").addClass("d-none");
                $(".content-fav .group-btn").removeClass("d-none");
            }else{
                $(".empty-noti").removeClass("d-none");
                $(".content-fav .group-btn").addClass("d-none");
            }
        });

        $(document).on("click", ".btn-close-modal-item", function() {
            var d = new Date();
            var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
            var expires = new Date(strDate.replace(' ', 'T'));
            expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000));
            var count_favorite = 0;
            var favorite = [];
            var cookie = $.cookie("project");
            var data_project = $(this).attr("data-project");
            if($.cookie("project") !== undefined && $.cookie("project") !== null){
                $(".li-heart").removeClass("run-shake").stop().addClass("run-shake");
                setTimeout(function () {
                    $(".li-heart").removeClass("run-shake");
                }, 700);
                var count_like_check = $('.count-check-like').text();
                favorite = JSON.parse($.cookie("project"));
                count_favorite = favorite.length;

                if(count_favorite > 0){
                    var modal = $(this).parent().find('.check-project');
                    if(modal.is(':checked')){

                        $('.count-check-like').text(parseInt(count_like_check) - 1);
                    }
                    if($(this).hasClass('added')){
                        project = $.grep(project, function(value){
                            $(this).removeClass('added');
                            $(".btn-like[data-project='"+data_project+"']").removeClass('added');
                            $(".heart-like[data-project='"+data_project+"']").removeClass('liked');
                            $(".btn-favorite[data-project='"+data_project+"']").removeClass('added');
                            return value != data_project;
                        });
                        count_favorite--;
                        $('.count-like').text(count_favorite);
                        $('.li-heart').attr("data-total", count_favorite);
                        var data = JSON.stringify(project);
                        $.cookie("project", data, { expires: expires });
                        if(count_favorite > 0){
                            $(".empty-noti").addClass("d-none");
                        }else{
                            $(".empty-noti").removeClass("d-none");
                        }
                    }
                }
            }
        });

        $(document).on("change", ".check-project", function(){
            var project = $(this).data("check");
            var count_like_check = $('.count-check-like').html();
            if(!$(this).is(':checked')){
                // $(".simple-bar").find("[data-check='"+project+"']").prop('checked', false); 
                // $(".simple-bar-showflat").find("[data-check='"+project+"']").prop('checked', false);
                var list = $(".simple-bar-showflat").find(".check-project");
                var check = '';
                $.each(list, function(index, element) {
                    if(this.checked){
                        check += $(this).attr("data-check")+","; 
                    }
                });
                $('.count-check-like').text(parseInt(count_like_check) - 1);
            }else{
                // $(".simple-bar").find("[data-check='"+project+"']").prop('checked', true);
                // $(".simple-bar-showflat").find("[data-check='"+project+"']").prop('checked', true);
                var list = $(".simple-bar-showflat").find(".check-project");
                var check = '';
                $.each(list, function(index, element) {
                    if(this.checked){
                        check += $(this).attr("data-check")+","; 
                    }
                });
                $('.count-check-like').text(parseInt(count_like_check) + 1);
            }
            $(".project_choose").val(check.slice(0, -1));
        });

        // $(".date-item").click(function(){
        //     var date = $(this).data("date");
        //     var d = new Date(date);
        //     var day = d.getDate();
        //     var month = d.getMonth() + 1;
        //     var year = d.getFullYear();
        //     var fulldate = year+"-"+month+"-"+day;
        //     $("#pick-date").val(fulldate);
        // });

        $("body").on('click', '.btn-favorite', function(){      
            var data_project = $(this).attr("data-project");
            if($(this).hasClass('added')){
                if($.cookie("project") !== undefined && $.cookie("project") !== null){
                    favorite = JSON.parse($.cookie("project"));
                }else{
                    favorite = [];
                }
                var project = favorite;
                count_favorite = favorite.length;
                $(".btn-like[data-project='"+data_project+"']").removeClass("added");
                $(this).removeClass('added');
                $(".li-heart").removeClass("run-shake").stop().addClass("run-shake");
                setTimeout(function () {
                    $(".li-heart").removeClass("run-shake");
                }, 700);
                project = $.grep(project, function(value){
                    $(this).removeClass('added');
                    return (value != data_project && value);
                });
                count_favorite--;
                $('.fav-line').filter(function(){
                    return $(this).data('favorite') == data_project
                }).remove();
            }else{
                if($.cookie("project") !== undefined && $.cookie("project") !== null){
                    favorite = JSON.parse($.cookie("project"));
                }else{
                    favorite = [];
                }
                var project = favorite;
                count_favorite = favorite.length;
                $(".li-heart").removeClass("run-popout").stop().addClass("run-popout");
                setTimeout(function () {
                    $(".li-heart").removeClass("run-popout");
                }, 700); 
                $('.content-fav .group-btn').removeClass('d-none');
                project.push(data_project);
                count_favorite++;
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:'POST',
                    url: '{{ route('add.favorite') }}',
                    data: {
                        add_favorite: data_project
                    },
                    dataType: 'json',
                    success:function(reponses){
                        $.each(reponses, function(index, element) {
                            var project_id = element.id;
                            var images = element.project_slides;
                            var first_image = '';
                            if(images != ''){
                                var first_image = JSON.parse(images)[0];
                            }
                            var name = element.name;
                            var district_name = element.district_name;
                            var tenure_name = element.tenure_name;
                            var project_slug = element.slug;
                            var link = '{{ route('frontend.project.detail', ['slug' => ':slug']) }}';
                            link = link.replace(':slug', project_slug);
                            var html_favorite = '<div class="fav-line" data-favorite="'+project_id+'">';
                            html_favorite += '<div class="fav-line-left">';
                            html_favorite += '<div class="img-bg" style="background-image:url('+first_image+')"><img src="'+first_image+'" alt="'+name+'"></div>';
                            html_favorite += '</div>';
                            html_favorite += '<div class="fav-line-right"> <a class="title" href="'+link+'">'+name+'</a>';
                            html_favorite += '<div class="info"><span>'+district_name+'</span><span>'+tenure_name+'</span>';
                            html_favorite += '<input class="check-fav-line-'+project_id+' check-project" data-check="'+project_id+'" type="checkbox" name="check" id="checkedmodal'+project_id+'">';
                            html_favorite += '<label for="checkedmodal'+project_id+'"> </label>';
                            html_favorite += '</div></div>';
                            html_favorite += '<div class="btn-close-modal-item added" data-project="'+project_id+'"> </div></div>';
                            $(".simple-bar").append(html_favorite);
                            var html_showflat = '<div class="fav-line swiper-slide" data-favorite="'+project_id+'">';
                            html_showflat += '<div class="fav-line-left">';
                            html_showflat += '<div class="img-bg" style="background-image:url('+first_image+')"><img src="'+first_image+'" alt="'+name+'"></div>';
                            html_showflat += '</div>';
                            html_showflat += '<div class="fav-line-right"> <a class="title" href="'+link+'">'+name+'</a>';
                            html_showflat += '<div class="info"><span>'+district_name+'</span><span>'+tenure_name+'</span>';
                            html_showflat += '<input class="check-fav-line-'+project_id+' check-project" data-check="'+project_id+'" type="checkbox" name="check" id="checkedmodal'+project_id+'">';
                            html_showflat += '<label for="checkedmodal'+project_id+'"> </label>';
                            html_showflat += '</div></div>';
                            html_showflat += '<div class="btn-close-modal-item added" data-project="'+project_id+'"> </div></div>';
                            $("#simple-bar-showflat").append(html_showflat);
                            $(".btn-like[data-project='"+data_project+"']").addClass("added");
                            $(".btn-favorite[data-project='"+project_id+"']").addClass("added");
                        });
                    }
                });
            }
            $(".simplebar-placeholder").css({"min-height":+parseInt(count_favorite * 134)+"px"});
            var data = JSON.stringify(project);
            $('.count-like').text(count_favorite);
            $('.li-heart').attr("data-total", count_favorite);
            $.cookie("project", data, { expires: expires });
            if(count_favorite > 0){
                $(".empty-noti").addClass("d-none");
                $(".content-fav .group-btn").removeClass("d-none");
            }else{
                $(".empty-noti").removeClass("d-none");
                $(".content-fav .group-btn").addClass("d-none");
            }
        });

        $('.tenure-option').on('click', function(){
            var tenure_val = $(this).data('search');
            $('#tenure-input').val(tenure_val);
        });

        $('.district-option').on('click', function(){
            var district_val = $(this).data('search');
            $('#district-input').val(district_val);
        });

        $('.type-option').on('click', function(){
            var type_val = $(this).data('search');
            $('#type-input').val(type_val);
        })
    });
</script>

<!--Message Submit Showflat--> 

@if(\Session::has('success-showflat'))
<script>
    swal("Success!", "{!! \Session::get('success-showflat') !!}", "success");
</script>
@endif

@if(\Session::has('success-contact'))
<script>
    swal("Success!", "{!! \Session::get('success-contact') !!}", "success");
</script>
@endif

@if(\Session::has('failed'))
<script>
    swal("Failed!", "{!! \Session::get('failed') !!}", "danger");
</script>
@endif

@if (count($errors) > 0)
<script>
@php
    $errors_message = '';
@endphp
@foreach ($errors->all() as $key => $error)
    @php
        $errors_message .= "-".$error.'\n'
    @endphp
@endforeach
    swal({
      title: "Errors!",
      text: "{!! $errors_message !!}",
      icon: "error",
    });
</script>
@endif

<!--Search Load Text-->

@if(!empty(request()->query('tenure')[0]))
    <script>
        var tenure = $('.tenue').find('.choosing').data('value');
        $('.tenure-select').html(tenure);
    </script>
@endif

@if(!empty(request()->query('district')[0]))
    <script>
        var district = $('.district').find('.choosing').data('value');
        $('.district-select').html(district);
    </script>
@endif

@if(!empty(request()->query('type')[0]))
    <script>
        var type = $('.type').find('.choosing').data('value');
        $('.type-select').html(type);
    </script>
@endif

@stack('script')

{!! isset($arr_setting['chat_script']) ? $arr_setting['chat_script'] : NULL !!}
<script async>
    $(window).on('load',function(){
        ui_fav_line();
        if ($(window).width() < 992) {        
            $('#modalPopovers').modal('show');
            $('#modalPopovers').css({"z-index":"-999"});
            $('#modalPopovers').removeClass('fade');
            $('.modal-backdrop').css({"z-index":"-999"});   
            setTimeout(function () {
              $('#modalPopovers').modal('hide');
              $('#modalPopovers').css({"z-index":"1050"});
              $('.modal-backdrop').css({"z-index":"1050"});
              $('#modalPopovers').addClass('fade');
            }, 500);
        }
    });
</script>
</body>

</html>