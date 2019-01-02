@if ($paginator->hasPages())
    <ul class="pagination pagination-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled page-item"><a class="page-link" href="#">Sebelumnya</a></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Selanjutnya</a></li>
        @else
            <li class="disabled page-item"><a class="page-link" href="#">Selanjutnya</a></li>
        @endif
    </ul>
@endif
