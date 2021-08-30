@extends('themes.master')
@section('content')
   <!-- Start Blog  -->
   <div class="latest-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="special-menu text-center">
                    <div class="button-group filter-button-group">
                        <button class="filter {{ !request('cate') ? 'active' : '' }}" data-url="{{ getPageUrlByCode('NEWS') }}">Tất Cả</button>
                        @foreach ($newsCategories as $newCategory )
                            <button class="filter {{ request('cate') && request('cate') == $newCategory->id ? 'active' : '' }}" 
                                data-url="{{ url()->current() }}?cate={{ $newCategory->id  }}">
                                {{ $newCategory->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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
                        <div class="blog-box" style="cursor: pointer;" 
                            data-url="{{ route('news.detail', ['slug' => $newsItem->slug ]) }}"
                        >
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
            @else
            <p>Không tìm thấy tin tức nào hết</p>
            @endif
        </div>
        {{ $news->links('paginations.index') }}
    </div>
</div>
<!-- End Blog  -->
@endsection
@push('script')
    <script>
        $(function() {
            $('.blog-box').on('click', function () {
                var $url = $(this).attr('data-url');
                window.location.href = $url;
            });

            $('.filter').on('click', function () {
                var $url = $(this).attr('data-url');
                window.location.href = $url;
            });
        });
        
    </script>
@endpush