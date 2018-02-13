@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li style="color: white;background: #00000061;"  class="disabled"><span>@lang('pagination.previous')</span></li>
        @else
            <li><a style="color: white;background: #00000061;"  href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a style="color: white;background: #00000061;"  href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li style="color: white;background: #00000061;"  class="disabled"><span>@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif
