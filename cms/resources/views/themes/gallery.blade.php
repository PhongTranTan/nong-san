@extends('themes.master')
@section('content')
    <!-- Start All Title Box -->
    @php 
        $image = null;
        if (isset($banners) && count($banners) > 0) {
            $image = $banners[0]->image;
        }
    @endphp
    <div class="all-title-box" @if($image) style="background: url({{ $image }})" @endif>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Services</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang Chủ</a></li>
                        <li class="breadcrumb-item active">Thư Viện Ảnh</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Gallery  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>{{  $page->description }}</h1>
                        <p>{!!  $page->content !!}</p>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            <button data-filter=".bulbs">Bulbs</button>
                            <button data-filter=".fruits">Fruits</button>
							<button data-filter=".podded-vegetables">Podded vegetables</button>
							<button data-filter=".root-and-tuberous">Root and tuberous</button>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row special-list">
                @foreach ( json_decode($arr_setting['images']) as $item)
                    <div class="col-lg-3 col-md-6 special-grid bulbs">
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <div class="type-lb">
                                    <p class="sale">Giảm Giá</p>
                                </div>
                                <img src="{{ $item->image }}" class="img-fluid" alt="Image">
                                <div class="mask-icon">
                                    <ul>
                                        <li>
                                            <a href="{{ getPageUrlByCode('SHOP') }}" data-toggle="tooltip" data-placement="right" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Gallery  -->
@endsection