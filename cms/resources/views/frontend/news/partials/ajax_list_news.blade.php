 <div class="container">           
    <div class="gallery-item row">
        @if(isset($news) && $news != null)
            @foreach($news as $newsItem)
                <div class="col-lg-4 col-md-6">
                    <a class="img-item" 
                        href="{{ route('frontend.news.detail',['slug' => $newsItem->slug]) }}">
                        <div class="img-bg lazy" 
                            data-src="{{ (isset($newsItem->images)) ? $newsItem->images : null }}"
                            style="background-image: url({{ (isset($newsItem->images)) ? $newsItem->images : null }});"
                        >
                            <img src="{{ (isset($newsItem->images)) ? $newsItem->images : null }}" 
                                alt="">
                        </div>
                        <div class="dark-layer-bottom">
                            <div class="title">
                                {{ (isset($newsItem->name)) ? $newsItem->name : null }}
                            </div>
                            <div class="desc dotdotdot">
                                {{ (isset($newsItem->description)) ? $newsItem->description : null }}
                            </div>
                        </div>
                        <div class="dark-layer"></div>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</div>
<p></p>
{{ $news->links('paginations.index') }}