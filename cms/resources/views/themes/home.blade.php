@extends('themes.master')
@section('content')
     <!-- Start Slider -->
     <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            @if(isset($banners) && count($banners) > 0)
                @foreach($banners as $banner) 
                    <li class="text-center">
                        <img src="{{ $banner->image }}" alt="">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="m-b-20"><strong>{{ $banner->title }}</strong></h1>
                                    <p class="m-b-40">{{ $banner->description }}</p>
                                    <p><a class="btn hvr-hover" href="{{ getPageUrlByCode('SHOP') }}">Xem Sản Phẩm</a></p>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">
                @foreach ($productTypes as $productType)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="shop-cat-box">
                            <img class="img-fluid" src="{{ $productType->images ?? 'images/categories_img_01.jpg'}}" alt="" />
                            <a class="btn hvr-hover" href="#">{{ $productType->name }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Categories -->

    <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            @if(!empty($blocks['FARM']) && $farmer = $blocks->get('FARM')->first())
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-all text-center">
                            <h1>{{ $farmer->name }}</h1>
                            <p>{{ $farmer->description }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                @if(isset($news))
                    @foreach ( $news as $newsItem )
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="blog-box" style="cursor: pointer;" data-url="https://google.vn">
                                <div class="blog-img">
                                    <img class="img-fluid" src="{{ $newsItem->images ?? 'images/blog-img-02.jpg'}}" alt="" />
                                </div>
                                <div class="blog-content">
                                    <div class="title-blog">
                                        <p>Thời gian: {{ date("d/m/Y", strtotime($newsItem->publish_date)) }}</p>
                                        <h3>{{ $newsItem->title }}</h3>
                                        <p>{{ $newsItem->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- End Blog  -->
	

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            @if(!empty($blocks['FRUITES']) && $fruites = $blocks->get('FRUITES')->first())
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>{{ $fruites->name }}</h1>
                        <p>{{ $fruites->description }}</p>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">Tất Cả</button>
                            <button data-filter=".top-featured">Sản Phẩm Top</button>
                            <button data-filter=".best-seller">Bán Chạy</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row special-list">
                @if (isset($products))
                    @foreach ( $products as $key => $product)
                        @if ($key % 2 == 0)
                            <div class="col-lg-3 col-md-6 special-grid best-seller">
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <div class="type-lb">
                                            <p class="sale">Giảm Giá</p>
                                        </div>
                                        <img src="{{ $product->images ?? 'images/img-pro-01.jpg'}}" class="img-fluid" alt="Image">
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
                                        <h4>{{ $product->name }}</h4>
                                        <h5>{{ number_format($product->price) }} đ</h5>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-3 col-md-6 special-grid top-featured">
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <div class="type-lb">
                                            <p class="new">Mới</p>
                                        </div>
                                        <img src="{{ $product->images ?? 'images/img-pro-02.jpg'}}" class="img-fluid" alt="Image">
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
                                        <h4>{{ $product->name }}</h4>
                                        <h5>{{ number_format($product->price) }} đ</h5>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- End Products  -->
    
	<div class="box-add-products">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="offer-box-products">
						<img class="img-fluid" src="{{ json_decode($arr_setting['ads'])[0]->image  ?? 'images/add-img-01.jpg'}}" alt="" />
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="offer-box-products">
						<img class="img-fluid" src="{{ json_decode($arr_setting['ads'])[1]->image ?? 'images/add-img-01.jpg'}}" alt="" />
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('script')
    <script>
        $(function() {
            $('.blog-box').on('click', function () {
                var $url = $(this).attr('data-url');
                window.location.href = $url;
            });
        });
        
    </script>
@endpush