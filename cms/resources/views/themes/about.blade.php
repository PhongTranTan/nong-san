@extends('themes.master')
@section('content')
@php 
    $image = null;
    if (isset($banners) && count($banners) > 0) {
        $image = $banners[0]->image;
    }
@endphp
    <!-- Start All Title Box -->
    <div class="all-title-box" @if($image) style="background: url({{ $image }})" @endif>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Về Chúng Tôi</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
                        <li class="breadcrumb-item active">Về Chúng Tôi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">

            @if(!empty($blocks['BLOCK01']) && $block1 = $blocks->get('BLOCK01')->first())
                <div class="row">
                    <div class="col-lg-6">
                        <div class="banner-frame">
                            <img class="img-fluid" src="{{ $block1->photo }}" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="noo-sh-title-top">{{ $block1->name }}</h2>
                        <p>{!! $block1->content !!}</p>
                    </div>
                </div>
            @endif 

            @if(!empty($blocks['LIST01']) && $list1 = $blocks->get('LIST01')->first())
                <div class="row my-5">
                    @if(count($list1->children) > 0)
                        @foreach ($list1->children as $item)
                            <div class="col-sm-6 col-lg-4">
                                <div class="service-block-inner">
                                    <h3>{{ $item->name }}</h3>
                                    <p>{!! $item->content !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif
            
            @if(!empty($blocks['OURTEAM']) && $team = $blocks->get('OURTEAM')->first())
                <div class="row my-4">
                    <div class="col-12">
                        <h2 class="noo-sh-title">Meet Our Team</h2>
                    </div>
                    @if(count($team->children) > 0)
                        @foreach ($team->children as $te)
                            <div class="col-sm-6 col-lg-3">
                                <div class="hover-team">
                                    <div class="our-team">
                                        <img src="{{ $te->photo ?? 'images/img-1.jpg' }}" alt="" />
                                        <div class="team-content">
                                            <h3 class="title">{{ $te->name }}</h3>
                                            <span class="post">{{ $te->description }}</span> </div>
                                        <ul class="social">
                                            <li>
                                                <a href="facebook.com" class="fab fa-facebook"></a>
                                            </li>
                                            <li>
                                                <a href="twitter.com" class="fab fa-twitter"></a>
                                            </li>
                                            <li>
                                                <a href="google.com" class="fab fa-google-plus"></a>
                                            </li>
                                            <li>
                                                <a href="youtube.com" class="fab fa-youtube"></a>
                                            </li>
                                        </ul>
                                        <div class="icon"> <i class="fa fa-plus" aria-hidden="true"></i> </div>
                                    </div>
                                    <div class="team-description">
                                        <p>{!! $te->content !!}</p>
                                    </div>
                                    <hr class="my-0"> </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif
        </div>
    </div>
    <!-- End About Page -->
@endsection