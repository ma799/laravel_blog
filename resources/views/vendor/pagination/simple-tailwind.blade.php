@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flexbox mt-30">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="btn btn-white disabled">
                <i class="ti-arrow-left fs-9 mr-4"></i> Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-white">
                <i class="ti-arrow-left fs-9 mr-4"></i> Previous
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-white">
                Next <i class="ti-arrow-right fs-9 ml-4"></i>
            </a>
        @else
            <span class="btn btn-white disabled">
                Next <i class="ti-arrow-right fs-9 ml-4"></i>
            </span>
        @endif
    </nav>
@endif
