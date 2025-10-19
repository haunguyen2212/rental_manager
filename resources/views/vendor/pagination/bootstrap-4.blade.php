@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center gap-2 mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link d-flex align-items-center justify-content-center rounded-1" style="width:35px;height:35px;">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link d-flex align-items-center justify-content-center rounded-1" style="width:35px;height:35px;"
                       href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link d-flex align-items-center justify-content-center rounded-1" style="width:35px;height:35px;">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link d-flex align-items-center justify-content-center rounded-1" style="width:35px;height:35px;">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link d-flex align-items-center justify-content-center rounded-1" style="width:35px;height:35px;"
                                   href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link d-flex align-items-center justify-content-center rounded-1" style="width:35px;height:35px;"
                       href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link d-flex align-items-center justify-content-center rounded-1" style="width:35px;height:35px;">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
