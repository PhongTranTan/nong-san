<!DOCTYPE html>
<!--MODAL PROJECT DETAIL PAGE-->
<!--text filter banner-->
<html lang="vi">
    <head>
        <title></title>
        <meta charset="utf-8">
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
        <meta name="theme-color" content="#0074E5">
        <meta name="msapplication-navbutton-color" content="#0074E5">
        <meta name="apple-mobile-web-app-status-bar-style" content="#0074E5">
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/images/icons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/images/icons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/images/icons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/icons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/images/icons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/images/icons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/images/icons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/icons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/icons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/icons/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/icons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/icons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/icons/favicon-16x16.png') }}">
        <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.ico') }}">
        <link rel="manifest" href="{{ asset('assets/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#f05b28">
        <meta name="msapplication-TileImage" content="{{ asset('assets/images/icons/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#f05b28">
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    </head>
    <body>       
        <main class="wrapper">
            <section class="section-nopage">
                <div class="container content-nopage">
                    <div class="row">
                        <div class="col-lg-7 content-left">
                            <div class="img-bg page lazy" style="background-image:url('images/banner-01.jpg');"><img src="/images/404.png" alt=""></div>
                        </div>
                        <div class="col-lg-4 offset-lg-1 content-right">
                            <div class="title">404</div>
                            <p>Page Not Found</p>
                            <button class="btn-nlp big blue" onclick="window.location.href='{{ url('/') }}'">Back To Homepage</button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- End Main Content-->
        <script src="{{ asset('assets/js/library.js') }}"></script>
        <script async src="{{ asset('assets/js/pages.js') }}"></script>
    </body>
</html>