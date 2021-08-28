@extends('frontend.layouts.master')

@push('style')
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')
<main class="wrapper grid-view">
    <div class="page-internal-wrapper">
        <!-- ALL NEW LAUNCHES: BANNER-->
        <section class="banner-page-small">
            <div class="slider-slick">
                @if(isset($banners) && count($banners) > 0)
                @foreach($banners as $banner) 
                <div class="slick-slide">
                    <div class="img-bg page lazy" style="background-image:url({{ (isset($banner) && $banner->image != null) ? asset($banner->image) : null }});"><img src="{{ (isset($banner) && $banner->image != null) ? asset($banner->image) : null }}" alt=""></div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="overlay-dark"> </div>
            <div class="container text-center">
                <div class="banner-text title">Get the best New Launches today</div>
            </div>
        </section>
        <!-- ALL NEW LAUNCHES: FILTER SEARCH FORM-->
        @include("frontend.layouts.partials.search_form")
        <!-- ALL NEW LAUNCHES : CONTENT-->
        <section class="section-margin nl-grid-section">
            <!-- ALL NEW LAUNCHES : VIEW MODE CONTROL-->
            <div class="container nl-container grid-control">
                <div class="breadcrumb-page">
                    <div class="container">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/" title="Homepage">Homepage</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Below $7000</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="filter-form form-sort">
                    <div class="sort-group">
                        <label class="font-weight-700">Sort by</label>
                        <form method="get" id="form-sort">
                            <input type="hidden" name="sort" value="{{ request()->get('sort') }}" id="sort">
                            <div class="tenue">
                                <div class="nl-dropbox">
                                    <div class="nl-select bordering">Name
                                    </div>
                                    <div class="nl-droplist">
                                        <div class="droplist-container">
                                            <div class="droplist-content scroll-ui">
                                                <div class="item-value sort-by @if(request()->get('sort') == 'asc') choosing @endif" data-value="A-Z">A - Z</div>
                                                <div class="item-value sort-by @if(request()->get('sort') == 'desc') choosing @endif" data-value="Z-A">Z - A</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                                    <div class="view-control-group"><a class="btn-grid active" href="{{ getPageUrlByCode('BELOW-7000') }}">Grid </a><a class="btn-detail" href="{{ getPageUrlByCode('BELOW-7000-DETAILED') }}"> Detailed</a></div>
                </div>
            </div>
            <div class="container nl-container">
                <div class="content-grid-view">
                    <div class="row gutter-20">
                        @if(isset($projects) && $projects != null)
                        @foreach($projects as $project)

                        <div class="col-lg-4 col-md-6">
                            <div class="nl-grid-item">
                                <div class="img">
                                    <div class="owl-carousel">
                                        @if($project->project_slides != null)
                                        @php 
                                            $slides = json_decode($project->project_slides); 
                                        @endphp
                                            @if(count($slides) > 0)
                                                @foreach($slides as $slide)
                                                <div class="img-item">
                                                    <a class="img-bg owl-lazy" href="{{ route('frontend.project.detail', ['slug' => $project->slug]) }}" data-src="{{ $slide }}"></a>
                                                </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="info">
                                    <h3 class="title font-weight-700"><a href="{{ route('frontend.project.detail', ['slug' => $project->slug]) }}">{{ (isset($project->name) && $project->name != null) ? $project->name : null }}</a></h3>
                                    <div class="desc">{{ (isset($project->description) && $project->description != null) ? $project->description : null }}</div>
                                    <div class="logo">
                                        <div class="img-bg" style="background-image:url('{{ (isset($project->develop) && $project->develop != null) ? asset($project->develop) : null }}')"><img src="{{ (isset($project->develop) && $project->develop != null) ? asset($project->project_logo) : null }}" alt="{{ (isset($project->name) && $project->name != null) ? $project->name : null }}"></div>
                                    </div>
                                </div>
                                <div class="link">
                                    <div class="link-item"><i class="icon icon-marker"></i><span>{{ $project->district_name }}</span></div>
                                    <div class="link-item"><i class="icon icon-paper"></i><span>{{ $project->tenure_name }}</span></div>
                                    <div class="link-item btn-like" data-project="{{ $project->id }}"><i class="icon icon-heart"></i><span class="l1">Project Saved</span><span class="l2">Add to Favourite</span></div>
                                </div>
                                @if($project->tag != null)
                                <div class="tag">
                                    @if(count($tags = explode(',',$project->tag)))
                                        @foreach($tags as $key => $tag)
                                        <span>{{ $tag }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                @endif
                                <div class="share"><a class="whatapps" href="https://wa.me/{{ (isset($project->whatsapp) && $project->whatsapp != null) ? $project->whatsapp : NULL }}"><i class="icon icon-hotline"></i></a>
                                    <div class="share-btn">
                                        <div class="icon-share-white"> 
                                            <div class="open-share">
                                                <div class="group-share" data-json="{&quot;id&quot;:&quot;{{ $project->id }}&quot;, &quot;url&quot;: {&quot;fbLink&quot;:&quot;{{ route('frontend.project.detail', ['slug' => $project->slug]) }}&quot;, &quot;twLink&quot;:&quot;{{ route('frontend.project.detail', ['slug' => $project->slug]) }}&quot;, &quot;lindLink&quot;:&quot;{{ route('frontend.project.detail', ['slug' => $project->slug]) }}&quot;}}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div>
                    <div class="pagination">{!! $projects->links() !!}</div>
                </div>
            </div>
        </section>
    </div>
</main>
<style>
    .clearfix{ clear: both; }
    .pagination{ text-align: center; margin: 15px auto; }
</style>
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
    $(".sort-by").on('click', function(){
        var sort = $(this).data('value');
        if(sort == 'A-Z'){
            $('#sort').val('asc');
        }
        iif(sort == 'Z-A'){
            $('#sort').val('desc');
        }
        $("#form-sort").submit();
    });
</script>    
@endpush
