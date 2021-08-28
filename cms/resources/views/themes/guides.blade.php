@extends('frontend.layouts.master')

@push('style')
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/css_new_03072021.css') }}" rel="stylesheet">
    <style>
        .page-item.active .page-link {
            color: #f2f2f2 !important;
            background-color: #a0ce4e !important;
            border-color: #a0ce4e !important;
        }

        .page-link:hover {
            z-index: 2;
            color: #a0ce4e;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        .page-link {
            color: #a0ce4e;
        }
        .active-cate {
            color: #f2f2f2;
            background-color: #a0ce4e;
        }

        .nl-tag {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 6;
            font-size: 13px; 
        }
        .nl-tag span {
            display: inline-block;
            max-width: 140px;
            padding: 3px 15px;
            overflow: hidden;
            font-weight: 500;
            color: #fff;
            text-overflow: ellipsis;
            text-transform: capitalize;
            white-space: nowrap;
            background-color: #c06014;
            border: 2px solid #fff;
            border-radius: 8px; 
        }
    </style>
@endpush

@section('content')
<main class="wrapper">
    <div class="page-internal-wrapper">
        <!-- GUIDES : BANNER-->
        <section class="banner-page-small">
            <div class="slider-slick">
                @if(isset($banners) && count($banners) > 0)
                @foreach($banners as $banner) 
                <div class="slick-slide">
                    <div class="img-bg page lazy" style="background-image:url({{ (isset($banner) && $banner->image != null) ? asset($banner->image) : null }});"><img src="{{ (isset($banner) && $banner->image != null) ? asset($banner->image) : null }}" alt=""></div>
                    <div class="container text-center">
                        <div class="banner-text title">{{ $banner->title }}</div>
                        <div class="banner-text sub dotdotdot">{{ $banner->description }}</div>
                    </div>
                    <div class="overlay-dark"> </div>
                </div>
                @endforeach
                @endif
            </div>
        </section>
        <!-- BREADCRUMB-->
        <div class="breadcrumb-page">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" title="Homepage">Homepage</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Guides</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="guides-page-section section-margin">
            <div class="container">  
                <div class="s-news_category">
                    <div class="m-category">
                        <div class="m-category_desc">Category:</div>
                        @if(isset($guidesCategories) && $guidesCategories)
                            <a class="m-category_item {{ !request('cate') ? 'active-cate' : '' }}" 
                                href="{{ getPageUrlByCode('GUIDES') }}">All</a>
                            @foreach($guidesCategories as $key => $guidesCategory)
                            <div class="m-category_wrapper">
                                <a class="m-category_item {{ request('cate') && request('cate') == $guidesCategory->id ? 'active-cate' : '' }}" 
                                    href="{{ getPageUrlByCode('GUIDES') }}?cate={{ $guidesCategory->id }}">{{ $guidesCategory->name }}</a>
                            </div>
                            @endforeach
                        @else
                            <p>Not found Categories</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- GUIDES : CONTENT    -->
        <section class="guides-page-section section-margin guides-list" id="pro-guides">
            <div class="container">           
                <div class="gallery-item row">
                	@if(isset($guides) && $guides != null)
                        @foreach($guides as $guide)
                        <div class="col-lg-4 col-md-6">
                            <a class="img-item" href="{{ route('frontend.guides.detail',['slug' => $guide->slug]) }}">
                                <div class="nl-tag">
                                    <span>{{ $guide->guidesCategory->name }}</span>
                                </div>
                                <div class="img-bg lazy" 
                                    data-src="{{ (isset($guide->images)) ? $guide->images : null }}"
                                    style="background-image: url({{ (isset($guide->images)) ? $guide->images : null }});"
                                >
                                    <img src="{{ (isset($guide->images)) ? $guide->images : null }}" alt="">
                                </div>
                                <div class="dark-layer-bottom">
                                    <div class="title">{{ (isset($guide->title)) ? $guide->title : null }}</div>
                                    <div class="desc dotdotdot">{{ (isset($guide->description)) ? $guide->description : null }}</div>
                                </div>
                                <div class="dark-layer"></div>
                            </a>
                        </div>
                        @endforeach
        			@endif
                </div>
            </div>
            <p></p>
            {{ $guides->links('paginations.index') }}
        </section>
    </div>
    <input type="hidden" name="cate" id="cate" value="{{ request('cate') }}">
</main>
@endsection

@section('footer')
    @include('frontend.layouts.partials.footer')
@endsection

@section('footer-page')
footer-page
@endsection

@section('button-bottom')
<div class="container-fluid footer-btn" id="btn-foot">                       
    <button class="btn-nlp blue" data-toggle="modal" data-target="#modalPopovers">Schedule Showflat Tour</button>
    <button class="btn-nlp green" onclick="window.location.href='https://wa.me/{{ (isset($arr_setting['whatsapp'])) ? $arr_setting['whatsapp'] : '#' }}'">WhatsApp</button>
</div>
@endsection

@push('script')
    <script src="{{ url('assets/js/library.js') }}"></script>
    <script async src="{{ url('assets/js/pages.js') }}"></script>
    <script>
        function pageLink() {
            $('#pro-guides').on('click', 'a.page-link', function (e) {
                e.preventDefault();
                let urlAction = $(this).attr('href');
                if (urlAction !== "javascript:void(0)") {
                    let cate = $("#cate").val();
                    if (cate) {
                        urlAction = urlAction + "&cate=" + cate;
                    }
                    $.ajax({
                        method: "GET",
                        url: urlAction,
                        success: function (res) {
                            $('.guides-list').html(res.data);
                        },
                        error: function () {
                            alert('Error get data !')
                        }
                    });
                }
            });
        }
        $(function() {
            pageLink();
        });
    </script>
@endpush
