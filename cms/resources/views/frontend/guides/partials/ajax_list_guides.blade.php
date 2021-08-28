<div class="container">           
    <div class="gallery-item row">
        @if(isset($guides) && $guides != null)
            @foreach($guides as $guide)
            <div class="col-lg-4 col-md-6">
                <a class="img-item" href="{{ route('frontend.guides.detail',['slug' => $guide->slug]) }}">
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