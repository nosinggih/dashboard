@props([
    'paginator',
])

@if ($paginator->hasPages())
    <nav class="c-pagination" aria-label="Navigasi halaman">
        <a
            href="{{ $paginator->previousPageUrl() ?? '#' }}"
            class="c-pagination__link {{ $paginator->onFirstPage() ? 'is-disabled' : '' }}"
            @if ($paginator->onFirstPage()) aria-disabled="true" tabindex="-1" @endif
        >
            <x-ui.icon name="chevron-left" :size="16" />
            <span class="sr-only">Sebelumnya</span>
        </a>

        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            <a
                href="{{ $url }}"
                class="c-pagination__link {{ $page === $paginator->currentPage() ? 'is-active' : '' }}"
                @if ($page === $paginator->currentPage()) aria-current="page" @endif
            >
                <span class="u-num">{{ $page }}</span>
            </a>
        @endforeach

        <a
            href="{{ $paginator->nextPageUrl() ?? '#' }}"
            class="c-pagination__link {{ ! $paginator->hasMorePages() ? 'is-disabled' : '' }}"
            @if (! $paginator->hasMorePages()) aria-disabled="true" tabindex="-1" @endif
        >
            <span class="sr-only">Selanjutnya</span>
            <x-ui.icon name="chevron-right" :size="16" />
        </a>
    </nav>
@endif
