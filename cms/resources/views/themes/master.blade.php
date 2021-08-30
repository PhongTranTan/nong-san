<!DOCTYPE html>
<html lang="en">
    <!-- Basic -->
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <base href="{{ url('') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Site Metas -->
        <title>Lập Trình Mạng</title>
        <meta name="author" content="trantanphong">
        @include('frontend.layouts.partials.seo')

        <!-- Site Icons -->
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <!-- Site CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

        <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet">
        <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet">
        <style>
            .special-grid {
                cursor: pointer;
            }
        </style>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <!-- Start Main Top -->
        <div class="main-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="right-phone-box">
                            <p>Gọi VN :- <a href="#"> {{ $arr_setting['phone'] }}</a></p>
                        </div>
                        <div class="our-link">
                            <ul>
                                <li>
                                    <a href="{{ getPageUrlByCode('CONTACT') }}">
                                        <i class="fas fa-headset"></i> Liên Hệ
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="text-slid-box">
                            <div id="offer-box" class="carouselTicker">
                                <ul class="offer-box">
                                    <li>
                                        <i class="fab fa-opencart"></i> 20% Giảm giá
                                    </li>
                                    <li>
                                        <i class="fab fa-opencart"></i> 50% - 80% Giảm giá
                                    </li>
                                    <li>
                                        <i class="fab fa-opencart"></i> 10%! Giảm giá
                                    </li>
                                    <li>
                                        <i class="fab fa-opencart"></i> 50%! Giảm giá
                                    </li>
                                    <li>
                                        <i class="fab fa-opencart"></i> 10%! Giảm giá
                                    </li>
                                    <li>
                                        <i class="fab fa-opencart"></i> 50% - 80% Giảm giá
                                    </li>
                                    <li>
                                        <i class="fab fa-opencart"></i> 20% off Giảm giá
                                    </li>
                                    <li>
                                        <i class="fab fa-opencart"></i> Off 50%! Giảm giá
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Top -->

        <!-- Start Main Top -->
        <header class="main-header">
            <!-- Start Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
                <div class="container">
                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button class="navbar-toggler" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#navbar-menu" 
                            aria-controls="navbars-rs-food" 
                            aria-expanded="false" 
                            aria-label="Toggle navigation"
                        >
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="/">
                            <img src="{{ $arr_setting['logo'] }}" class="logo" alt="">
                        </a>
                    </div>
                    <!-- End Header Navigation -->
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                            @foreach($composer_menu as $item_menu)
                                <li class="nav-item {{ request()->is($item_menu->url) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ $item_menu->url }}">
                                        {{ $item_menu->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->

                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                            <li class="search">
                                <a href="{{ getPageUrlByCode('SHOP') }}">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Atribute Navigation -->
                </div>
                <!-- Start Side Menu -->
                <div class="side">
                    <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                    <li class="cart-box">
                        <ul class="cart-list">
                            <li>
                                <a href="#" class="photo"><img src="images/img-pro-01.jpg" class="cart-thumb" alt="" /></a>
                                <h6><a href="#">Delica omtantur </a></h6>
                                <p>1x - <span class="price">$80.00</span></p>
                            </li>
                            <li>
                                <a href="#" class="photo"><img src="images/img-pro-02.jpg" class="cart-thumb" alt="" /></a>
                                <h6><a href="#">Omnes ocurreret</a></h6>
                                <p>1x - <span class="price">$60.00</span></p>
                            </li>
                            <li>
                                <a href="#" class="photo"><img src="images/img-pro-03.jpg" class="cart-thumb" alt="" /></a>
                                <h6><a href="#">Agam facilisis</a></h6>
                                <p>1x - <span class="price">$40.00</span></p>
                            </li>
                            <li class="total">
                                <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                                <span class="float-right"><strong>Total</strong>: $180.00</span>
                            </li>
                        </ul>
                    </li>
                </div>
                <!-- End Side Menu -->
            </nav>
            <!-- End Navigation -->
        </header>
        <!-- End Main Top -->
        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" 
                        data-url="{{ getPageUrlByCode('SHOP') }}" 
                        class="form-control search-key" 
                        placeholder="Tìm kiếm"
                    >
                    <span class="input-group-addon close-search">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
            </div>
        </div>
        <!-- End Top Search -->
        @yield('content')
        <!-- Start Instagram Feed  -->
        <div class="instagram-box">
            <div class="main-instagram owl-carousel owl-theme">
                @foreach ( json_decode($arr_setting['images_footer']) as $item)
                    <div class="item">
                        <div class="ins-inner-box">
                            <img src="{{ $item->image }}" alt="" />
                            <div class="hov-in">
                                <a href="{{ getPageUrlByCode('SHOP') }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- End Instagram Feed  -->
        <!-- Start copyright  -->
        <div class="footer-copyright">
            <p class="footer-company">
                &copy; {{ $arr_setting['description_footer'] }} 
            </p>
        </div>
        <!-- End copyright  -->
        <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
        <!-- ALL JS FILES -->
        <script src="{{ asset('assets/js/library_homepage.js') }}"></script>
        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            });
        </script>
        <script>
            $(function() {
                var keyWord = "";
                $('.search-key').on('keyup', function () {
                    keyWord = $('.search-key').val();
                    console.log(keyWord);
                });

                $(document).on('keypress',function(e) {
                    if(e.which == 13) {
                        var urlAction = $('.search-key').attr('data-url');                      
                        if (keyWord) {
                            window.location.href = urlAction + '?key=' + keyWord;
                        }
                    }
                });
            });
        </script>
        <!-- ALL PLUGINS -->
        <script src="{{ asset('assets/js/jquery.superslides.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-select.js') }}"></script>
        <script src="{{ asset('assets/js/inewsticker.js') }}"></script>
        <script src="{{ asset('assets/js/bootsnav.js.') }}"></script>
        <script src="{{ asset('assets/js/images-loded.min.js') }}"></script>
        <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/baguetteBox.min.js') }}"></script>
        <script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
        <script src="{{ asset('assets/js/contact-form-script.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        @stack('script')
    </body>
</html>