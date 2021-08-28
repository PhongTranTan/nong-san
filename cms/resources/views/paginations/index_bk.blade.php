@if ($paginator->hasPages())
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><span class="sr-only">{{trans('frontend_home.paginations.previous_page')}}</span></a></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><span class="sr-only">{{trans('frontend_home.paginations.previous_page')}}</span></a></li>
        @endif
        
        @if($paginator->currentPage() > 3)
            <li class="page-item hidden-xs"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        
        @if($paginator->currentPage() > 4)
            <li><span>&#160;...&#160;</span></li>
        @endif
        
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active"><a class="page-link" href="javascript:void(0)">{{ $i }}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li><span>&#160;...&#160;</span></li>
        @endif
        
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="page-item hidden-xs">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><span class="sr-only">{{trans('frontend_home.paginations.next_page')}}</span></a></li>
        @else
            <li class="page-item disabled"><a class="page-link" href="#"><span class="sr-only">{{trans('frontend_home.paginations.next_page')}}</span></a></li>
        @endif
    </ul>
</nav>
@endif

<!-- <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled"><a class="page-link" href="#"><span class="sr-only">Trang trước</span></a></li>
        <li class="page-item active"><a class="page-link" href="#">1<span class="sr-only">(current)</span></a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link">...</a></li>
        <li class="page-item"><a class="page-link" href="#">9</a></li>
        <li class="page-item"><a class="page-link" href="#"><span class="sr-only">Trang sau</span></a></li>
    </ul>
</nav> -->