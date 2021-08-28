<!DOCTYPE html>
<html lang="{{ $composer_locale }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

<body>
	<div id="page">
        <main class="wrapper project-detail">
    		<div id="loader-wrapper">
    		    <div id="loader"></div>
    		    <div class="loader-section"></div>
    		    <div class="loader-icon @if(isset($project->option) && $project->option == 1) vertical @else horizontal @endif">
                    <div class="img-bg" style="background-image: url(@yield('logo-project'))"><img src="@yield('logo-project')" alt="{{ isset($project->name) ? $project->name : NULL }}">
                        </div>
               </div>
    		</div>
    		<div class="page-internal-wrapper">

    			@include('frontend.project.header')

    			<div class="pdetail-content" id="fullpagev2">

    			@yield('content')

    			@include('frontend.project.footer')

    			</div>
                <div class="pdetail-navside-toogle">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
                {{-- <div class="scroll-page" id="nextpage">
                    <span><i class="icon icon-scroll-page"> </i></span>
                </div> --}}
    		</div>
    	</main>
    </div>
	@yield('modal-project')

<script src="/assets/js/library.js"></script>
<script async src="/assets/js/product_detail.js"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="///maps.googleapis.com/maps/api/js?key={{ \Config::get('key.key_map') }}&amp;libraries=places&callback=initMap" async defer id="google-map"></script>
<script>
    $(function(){
        $("#menu-main a").on('click',function(){
            $("#menu-main a.active").removeClass("show active");
        });
    })
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}'
        }
    });
</script>

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


@stack('script')

{!! isset($arr_setting['chat_script']) ? $arr_setting['chat_script'] : NULL !!}
</body>
</html>