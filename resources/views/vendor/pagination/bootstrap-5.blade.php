@if ($paginator->hasPages())
    <nav>
        <ul class="pagination mb-0">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&lt;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        &lt;
                    </a>
                </li>
            @endif

            {{-- Pages --}}
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
            @endphp

            {{-- Halaman pertama --}}
            <li class="page-item {{ $current == 1 ? 'active' : '' }}">
                @if ($current == 1)
                    <span class="page-link">1</span>
                @else
                    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                @endif
            </li>

            {{-- Titik kiri --}}
            @if ($current > 4)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif

            {{-- Halaman sekitar current --}}
            @for ($i = max(2, $current - 1); $i <= min($last - 1, $current + 1); $i++)
                <li class="page-item {{ $current == $i ? 'active' : '' }}">
                    @if ($current == $i)
                        <span class="page-link">{{ $i }}</span>
                    @else
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    @endif
                </li>
            @endfor

            {{-- Titik kanan --}}
            @if ($current < $last - 3)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif

            {{-- Halaman terakhir --}}
            @if ($last > 1)
                <li class="page-item {{ $current == $last ? 'active' : '' }}">
                    @if ($current == $last)
                        <span class="page-link">{{ $last }}</span>
                    @else
                        <a class="page-link" href="{{ $paginator->url($last) }}">{{ $last }}</a>
                    @endif
                </li>
            @endif
            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        &gt;
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&gt;</span>
                </li>
            @endif

        </ul>
    </nav>
@endif
