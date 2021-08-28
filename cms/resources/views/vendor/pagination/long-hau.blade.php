@if ($paginator->hasPages())
    <div class="pagination">
        <ul class="clearfix" data-anim-type="fadeInUp" data-anim-delay="150">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><a aria-label="Previous"><i class="arrow_carrot-left"></i></a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="arrow_carrot-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a title="{{ $page }}">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="arrow_carrot-right"></i></a></li>
            @else
                <li class="disabled">
                    <a aria-label="Next">
                        <i class="arrow_carrot-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
