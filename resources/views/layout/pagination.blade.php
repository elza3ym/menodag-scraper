@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="paginate_button page-item previous disabled" id="multicolumn_ordering_table_previous">
                <a href="#" aria-controls="multicolumn_ordering_table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
            </li>
        @else
            <li class="paginate_button page-item previous" id="multicolumn_ordering_table_previous">
                <a href="{{ $paginator->previousPageUrl() }}" aria-controls="multicolumn_ordering_table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true">
                    <a href="#" aria-controls="multicolumn_ordering_table disabled" data-dt-idx="{{ $element }}" tabindex="0" class="page-link">{{ $element }}</a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button page-item active">
                            <a href="#" aria-controls="multicolumn_ordering_table" data-dt-idx="{{ $page }}" tabindex="0" class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="paginate_button page-item "><a href="{{ $url }}" aria-controls="multicolumn_ordering_table" data-dt-idx="{{ $page }}" tabindex="0" class="page-link">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button page-item next" id="multicolumn_ordering_table_next">
                <a href="{{ $paginator->nextPageUrl() }}" aria-controls="multicolumn_ordering_table" data-dt-idx="3" tabindex="0" class="page-link">Next</a>
            </li>

        @else
            <li class="paginate_button page-item next disabled" id="multicolumn_ordering_table_next">
                <a href="#" aria-controls="multicolumn_ordering_table" data-dt-idx="3" tabindex="0" class="page-link">Next</a>
            </li>
        @endif


    </ul>
@endif
