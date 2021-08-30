@extends('themes.master')
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box" style="background: url({{ $product->banner }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Chi Tiết Sản Phẩm</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Sản Phẩm</a></li>
                        <li class="breadcrumb-item active">Chi Tiết Sản Phẩm</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> <img class="d-block w-100" src="images/big-img-01.jpg" alt="First slide"> </div>
                            <div class="carousel-item"> <img class="d-block w-100" src="images/big-img-02.jpg" alt="Second slide"> </div>
                            <div class="carousel-item"> <img class="d-block w-100" src="images/big-img-03.jpg" alt="Third slide"> </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span> 
                    </a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
                        <i class="fa fa-angle-right" aria-hidden="true"></i> 
                        <span class="sr-only">Next</span> 
                    </a>
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                                <img class="d-block w-100 img-fluid" src="images/smp-img-01.jpg" alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="1">
                                <img class="d-block w-100 img-fluid" src="images/smp-img-02.jpg" alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="2">
                                <img class="d-block w-100 img-fluid" src="images/smp-img-03.jpg" alt="" />
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{!! $product->name !!}</h2>
                        <h5> <del>{{ number_format($product->price) }} đ</del> {{ number_format($product->price) }} đ</h5>
                        <h4>{{ $product->description }}</h4>
                        <p>{!! $product->content !!}</p>
                        <ul>
                            <li>
                                {{-- <div class="form-group quantity-box">
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control" value="0" min="0" max="20" type="number">
                                </div> --}}
                            </li>
                        </ul>

                        <div class="price-box-bar">
                          
                        </div>

                        <div class="add-to-btn">
                            <div class="share-bar">
                                <a class="btn hvr-hover" href="https://facebook.com"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://google.vn"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://pinterest"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="https://whatapp.com"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($productRela->count() > 0)
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="title-all text-center">
                            <h1>Sản Phẩm Liên Quan</h1>
                            <p>Sản phẩm liên quan nổi bật</p>
                        </div>
                        <div class="featured-products-box owl-carousel owl-theme">
                            @foreach ($productRela as $productItem)
                                <div class="item" style="cursor: pointer" 
                                    data-url="{{ route('product.detail', ['slug' => $productItem->slug]) }}"
                                >
                                    <div class="products-single fix">
                                        <div class="box-img-hover">
                                            <img src="{{ $productItem->images ?? 'images/img-pro-01.jpg' }}" class="img-fluid" alt="Image">
                                            <div class="mask-icon">
                                                <ul>
                                                    <li>
                                                        <a href="#" data-toggle="tooltip" data-placement="right" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </li>    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="why-text">
                                            <h4>{{ $productItem->name }}</h4>
                                            <h5>{{ number_format($productItem->price) }}đ</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- End Cart -->
@endsection
@push('script')
    <script>
        $(function() {
            $('.blog-box').on('click', function () {
                var $url = $(this).attr('data-url');
                window.location.href = $url;
            });

            $('.item').on('click', function () {
                var $url = $(this).attr('data-url');
                window.location.href = $url;
            });
        });
        
    </script>
@endpush