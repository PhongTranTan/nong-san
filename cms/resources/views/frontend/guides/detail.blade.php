@extends('frontend.layouts.master')

@push('style')
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <style>
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
        <div class="breadcrumb-page">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" title="Homepage">Homepage</a></li>
                        <li class="breadcrumb-item"><a href="{{ getPageUrlByCode('GUIDES') }}" title="{{ getPageTitleByCode('GUIDES') }}">{{ getPageTitleByCode('GUIDES') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $guides->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- GUIDES : CONTENT    -->
        <section class="guides-page-section section-margin mg-top-20">
            <div class="container"> 
                <div class="guides-content">
                    <div class="inner-content-top">
                        <div class="guides-title">{{ $guides->title }}</div>
                        <div class="external">
                            <div class="icon-share-white">Share
                                <div class="overlay-layer"></div>
                                <div class="open-share">
                                    <div class="group-share" data-json="{&quot;id&quot;:&quot;{{ $guides->id }}&quot;, &quot;url&quot;: {&quot;fbLink&quot;:&quot;{{ route('frontend.guides.detail', ['slug' => $guides->slug]) }}&quot;, &quot;twLink&quot;:&quot;{{ route('frontend.guides.detail', ['slug' => $guides->slug]) }}&quot;, &quot;lindLink&quot;:&quot;{{ route('frontend.guides.detail', ['slug' => $guides->slug]) }}&quot;}}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>Published date: {{ date("d/m/Y", strtotime($guides->publish_date)) }}</p>
                    <div class="inner-content">
                        {!! $guides->content !!}
                    </div>
                </div>
                @if(isset($related_guides) && $related_guides != null)
                <section class="guides-section">
                    <div class="container">
                        <div class="box-border">
                            <h2 class="title big text-center">
                                Related <p>Guides</p>
                            </h2>
                        </div>
                        <div class="slides-gallery">
                            <div class="container">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach($related_guides as $related_guide)
                                        <a class="gallery-item swiper-slide" href="{{ route('frontend.guides.detail',['slug' => $related_guide->slug]) }}">
                                            <div class="nl-tag">
                                                <span>{{ $related_guide->guidesCategory->name }}</span>
                                            </div>
                                            <div class="img-star img-bg" style="background-image:url({{ $related_guide->images }})">
                                                <img src="{{ $related_guide->images }}" alt="{{ $related_guide->title }}">
                                                <div class="dark-layer"></div>
                                                <div class="dark-layer-bottom">
                                                    <div class="title gd-dotdotdot">{{ $related_guide->title }}</div>
                                                    <div class="desc dotdotdot">{{ $related_guide->description }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach 
                                    </div>
                                </div>
                                <div class="swiper-scrollbar"></div>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
            </div>
        </section>
    </div>
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
    <button class="btn-nlp green" onclick="window.location.href='https://wa.me/{{ (isset($arr_setting['phone'])) ? $arr_setting['phone'] : '#' }}'">WhatsApp</button>
</div>
@endsection

@push('script')
<script src="{{ url('assets/js/library.js') }}"></script>
<script async src="{{ url('assets/js/pages.js') }}"></script>     
@endpush
