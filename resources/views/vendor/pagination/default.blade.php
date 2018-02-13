@if ($paginator->hasPages())

    <div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="pagination-item--wide first disabled"> <a class="pagination-link--wide first">Previous</a> </li>
        @else
            <li class="pagination-item--wide first">
                <a class="pagination-link--wide first" href="{{ $paginator->previousPageUrl() }}">Previous</a>
            </li>
        @endif



        {{-- Pagination Elements --}}
        @foreach ($elements as $element)

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pagination-item is-active"> <a class="pagination-link"><span>{{ $page }}</span></a> </li>
                    @else
                        <li class="pagination-item"> <a class="pagination-link" href="{{ $url }}"><span>{{ $page }}</span></a> </li>

                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="{{ $paginator->nextPageUrl() }}">
                    Next</a>
            </li>
        @else
            <li class="pagination-item--wide last disabled">
                <a class="pagination-link--wide last" href="{{ $paginator->nextPageUrl() }}">
                    Next
                </a>
            </li>
        @endif

    </div>

@endif
