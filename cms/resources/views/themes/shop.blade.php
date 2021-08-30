@extends('themes.master')
@section('content')
     <!-- Start Products  -->
     <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="filter {{ !request('cate') ? 'active' : '' }}" data-url="{{ getPageUrlByCode('SHOP') }}">Tất Cả</button>
                            @foreach ($productTypes as $productType )
                                <button  class="filter {{ request('cate') && request('cate') == $productType->id ? 'active' : '' }}" 
                                    @php 
                                        $param = "";
                                        if (request('key')) {
                                            $param = "&key=" . request('key');
                                        }
                                    @endphp                                   
                                    data-url="{{ getPageUrlByCode('SHOP') . "?cate=$productType->id" . $param }}"
                                >{{ $productType->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="row special-list new-list" id="pro-news">
                    @if (isset($products) && $products->count() > 0)
                        @foreach ( $products as $key => $product)
                            @if ($key % 2 == 0)
                                <div class="col-lg-3 col-md-6 special-grid best-seller"
                                    data-url="{{ route('product.detail', ['slug' => $product->slug]) }}"
                                >
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
                                <div class="col-lg-3 col-md-6 special-grid top-featured"
                                    styles="cursor: pointer;"
                                    data-url=""
                                >
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
                    @else
                        <p>Không tìm thấy sản phẩm nào cả</p>
                    @endif
                </div>
                {{ $products->links('paginations.index') }}
            </div>
            
        </div>
    </div>
    <!-- End Products  -->
@endsection
@push('script')
    <script>
        $(function() {
            $('.filter').on('click', function () {
                var $url = $(this).attr('data-url');
                window.location.href = $url;
            });

            $('.special-grid').on('click', function () {
                var $url = $(this).attr('data-url');
                window.location.href = $url;
            });
        });
        // function pageLink() {
        //     $('#pro-news').on('click', 'a.page-link', function (e) {
        //         alert('a');
        //         e.preventDefault();
        //         let urlAction = $(this).attr('href');
        //         if (urlAction !== "javascript:void(0)") {
        //             let cate = $("#cate").val();
        //             if (cate) {
        //                 urlAction = urlAction + "&cate=" + cate;
        //             }
        //             $.ajax({
        //                 method: "GET",
        //                 url: urlAction,
        //                 success: function (res) {
        //                     $('.news-list').html(res.data);
        //                 },
        //                 error: function () {
        //                     alert('Error get data !')
        //                 }
        //             });
        //         }
        //     });
        // }
        // $(function() {
        //     pageLink();
        // });
    </script>
@endpush