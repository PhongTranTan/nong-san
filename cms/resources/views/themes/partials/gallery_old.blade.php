<!-- code a.duy -->
<section class="section-full pdetail-s-gallery pdetail-spacing" data-anchor="gallery">
    <div class="wrap-info">
        <div class="pdetail-info">
            @if(isset($project->gallery_title))
                <h2 class="pdetail-title">{!! $project->gallery_title !!}</h2>
            @endif
            @if(isset($project->gallery_subtitle))
                <div class="tick">{!! $project->gallery_subtitle !!}</div>
            @endif
        </div>
        @if(isset($project->gallery_description))
            <div class="sub">{!! $project->gallery_description !!}</div>
        @endif
    </div>
    <div class="owl-carousel">
        @if(isset($project_galleries) && count($project_galleries) > 0)
            @php
                $i = 1;
                $count = (count($project_galleries) - 1) / 6;
            @endphp

            @for($j = 0; $j <= $count; $j++)
                @php $l = 1; @endphp
                <div class="item-slider">
                    <div class="grid-gallery">
                        <div class="grid-sizer"></div>
                        @for($k = $j * 6; $k <= $j * 6 + 5; $k++)
                            @if($i <= count($project_galleries))
                                @php $images = json_decode($project_galleries[$k]->images); @endphp
                                <div class="grid-item @if($i == 3) size-vertical @endif @if($i == 4 || $i == 6) small @endif @if($i == 5) size-horizontal @endif">
                                    <div class="item-img">
                                        @if(isset($images) && count($images))
                                            @foreach($images as $key_image => $image)
                                                @if($key_image == 0)
                                                    <a class="img-bg lazy" 
                                                        href="{{ asset($images[0]) }}" 
                                                        data-fancybox="images{{ $k }}" 
                                                        data-fancybox-toggle="images{{ $k }}" 
                                                        data-id="{{ $k }}" 
                                                        data-caption="{{ $project->name }}" 
                                                        style="background-image:url({{ isset($images[0]) ? asset($images[0]) : NULL }})"
                                                    >
                                                        <img src="{{ isset($images[0]) ? asset($images[0]) : NULL }}" 
                                                            alt="{{ $project->name }}">
                                                        <div class="mask"></div>
                                                    </a>
                                                @else
                                                    <div class="d-none">
                                                        <a href="{{ isset($image) ? asset($image) : NULL }}" 
                                                            data-id="{{ $k }}" 
                                                            data-fancybox="images{{ $k }}" 
                                                            data-caption="{{ $project->name }}" 
                                                            style="background-image:url({{ isset($image) ? asset($image) : NULL }})"
                                                        >
                                                            <img src="{{ isset($image) ? asset($image) : NULL }}" alt="{{ $project->name }}">
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                @php $i++; $l++; @endphp
                            @endif
                        @endfor
                    </div>
                </div>
            @endfor
        @endif
    </div>
</section>