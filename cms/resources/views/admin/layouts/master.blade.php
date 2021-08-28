<!DOCTYPE html>
<html lang="{{ $composer_locale }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{url('')}}">
    <title>Admin | {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield("meta")

    <!-- Favicon-->
    <link rel='shortcut icon' href='assets/images/logo.svg'/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
          type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="/assets/admin/css/app.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/admin/css/_hadesker.css">
    @include("admin.layouts.partials.define")

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
    {{-- <link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"> --}}

    @yield("style")
    <style>
        a.navbar-brand{
            color: black !important;
        }
    </style>
    <script src="/assets/admin/js/app.js?v=1521165460"></script>
</head>

<body class="theme-cyan">
<style>
    #cssload-pgloading:after{content:"";z-index:-1;position:absolute;top:0;right:0;bottom:0;left:0}#cssload-pgloading .cssload-loadingwrap{position:absolute;top:45%;bottom:45%;left:25%;right:25%}#cssload-pgloading .cssload-bokeh{font-size:97px;width:1em;height:1em;position:relative;margin:0 auto;list-style:none;padding:0;border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%}#cssload-pgloading .cssload-bokeh li{position:absolute;width:.2em;height:.2em;border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%}#cssload-pgloading .cssload-bokeh li:nth-child(1){left:50%;top:0;margin:0 0 0 -.1em;background:#00c176;transform-origin:50% 250%;-o-transform-origin:50% 250%;-ms-transform-origin:50% 250%;-webkit-transform-origin:50% 250%;-moz-transform-origin:50% 250%;animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate;-o-animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate;-ms-animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate;-webkit-animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate;-moz-animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate}#cssload-pgloading .cssload-bokeh li:nth-child(2){top:50%;right:0;margin:-.1em 0 0;background:#ff003c;transform-origin:-150% 50%;-o-transform-origin:-150% 50%;-ms-transform-origin:-150% 50%;-webkit-transform-origin:-150% 50%;-moz-transform-origin:-150% 50%;animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate;-o-animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate;-ms-animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate;-webkit-animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate;-moz-animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate}#cssload-pgloading .cssload-bokeh li:nth-child(3){left:50%;bottom:0;margin:0 0 0 -.1em;background:#fabe28;transform-origin:50% -150%;-o-transform-origin:50% -150%;-ms-transform-origin:50% -150%;-webkit-transform-origin:50% -150%;-moz-transform-origin:50% -150%;animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate;-o-animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate;-ms-animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate;-webkit-animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate;-moz-animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate}#cssload-pgloading .cssload-bokeh li:nth-child(4){top:50%;left:0;margin:-.1em 0 0;background:#88c100;transform-origin:250% 50%;-o-transform-origin:250% 50%;-ms-transform-origin:250% 50%;-webkit-transform-origin:250% 50%;-moz-transform-origin:250% 50%;animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate;-o-animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate;-ms-animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate;-webkit-animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate;-moz-animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate}@keyframes cssload-rota{to{transform:rotate(360deg)}}@-o-keyframes cssload-rota{to{-o-transform:rotate(360deg)}}@-ms-keyframes cssload-rota{to{-ms-transform:rotate(360deg)}}@-webkit-keyframes cssload-rota{to{-webkit-transform:rotate(360deg)}}@-moz-keyframes cssload-rota{to{-moz-transform:rotate(360deg)}}@keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}@-o-keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}@-ms-keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}@-webkit-keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}@-moz-keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}
</style>
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div id="cssload-pgloading">
        <div class="cssload-loadingwrap">
            <ul class="cssload-bokeh">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->

<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="/">ADMIN - {{ config('app.name') }}</a>
        </div>
    </div>
</nav>

@include("admin.layouts.partials.menu")

<section class="content">
    <div class="container-fluid">
   

        @yield("content")

    </div>
</section>

<div id="page__progress"
     style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; display: none; background-color: rgba(0, 0, 0, .6); z-index: 100;">
    <div class="progress" style="max-width: 400px; margin: auto; margin-top: calc(100vh / 2 - 30px)">
        <div class="progress-bar bg-cyan progress-bar-striped active" role="progressbar" aria-valuenow="0"
             aria-valuemin="0" aria-valuemax="100" style="width: 00%">
            0%
        </div>
    </div>
</div>

<script src="/assets/plugins/ckfinder/ckfinder.js?v=1521165460"></script>

<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
{{-- <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> --}}
@stack("add_script")

@yield("script")
    <script>
        function datatableRenderColumnNoOrder(className) {
            return {
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                },
                className: (className !== undefined ? className : 'text-center'),
                searchable: false,
                orderable: false
            }
        }
        $('.select2').select2();
    </script>
</body>
</html>
