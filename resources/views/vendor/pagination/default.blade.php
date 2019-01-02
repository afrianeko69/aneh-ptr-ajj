@php
# Get new and smaller elements
$elements = \App\Traits\PaginationHelper::render($paginator, 1);
@endphp
@if ($paginator->hasPages())
    <ul class="pagination pagination-sm flex-wrap">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled page-item"><a class="page-link" href="{{ $paginator->url(1) }}" rel="prev"><i class="fa fa-step-backward"></i></a></li>
            <li class="disabled page-item"><a class="page-link" href="#"><i class="fa fa-caret-left"></i></a></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}" rel="prev"><i class="fa fa-step-backward"></i></a></li>
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-caret-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $e => $element)

            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><a class="page-link" href="#"><span>{{ $element }}</span></a></li>

            {{-- Array Of Links --}}
            @elseif (is_array($element))
                @foreach ($element as $page => $url)

                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" href="#"><span>{{ $page }}</span></a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif

                @endforeach
            @endif

        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-caret-right"></i></a></li>
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next"><i class="fa fa-step-forward"></i></a></li>
        @else
            <li class="disabled page-item"><a class="page-link" href="#"><i class="fa fa-caret-right"></i></a></li>
            <li class="disabled page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next"><i class="fa fa-step-forward"></i></a></li>
        @endif
    </ul>
@endif
