@extends('themes.master')
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box" style="background: url('/images/all-bg-title.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Chi Tiết Tin Tức</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang Chủ</a></li>
                        <li class="breadcrumb-item active">Chi Tiết Tin Tức</li>
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
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="single-product-details">
                        <h2>{!! $news->name !!}</h2>
                        <h4>{{ $news->description }}</h4>
                        <p>{!! $news->content !!}</p>
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
            @if($newsRela->count() > 0)
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Tin Tức Liên Quan</h1>
                        <p>Tin Tức liên quan nổi bật</p>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        @foreach ($newsRela as $newsItem)
                            <div class="item" style="cursor: pointer" 
                                data-url="{{ route('news.detail', ['slug' => $newsItem->slug]) }}"
                            >
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <img src="{{ $newsItem->images ?? 'images/img-pro-01.jpg' }}" class="img-fluid" alt="Image">
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
                                        <h4>{{ $newsItem->name }}</h4>
                                        <p>{!! $newsItem->description !!}</p>
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