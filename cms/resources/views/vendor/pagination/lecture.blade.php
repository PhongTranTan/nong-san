@if ($paginator->hasPages())
    <ul class="pagination justify-content-end">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item"><a class="page-link" href="javascript:void(0)"><span class="ic-first"></span></a></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" ><i class="ic-first"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item"><a class="page-link" href="javascript:void(0)">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" title="{{ $page }}" href="javascript:void(0)">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" title="{{ $page }}" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" ><span class="ic-last"></span></a></li>
        @else
            <li class="page-item"><a class="page-link" href="javascript:void(0)" ><span class="ic-last"></span></a></li>
        @endif
    </ul>
@endif
