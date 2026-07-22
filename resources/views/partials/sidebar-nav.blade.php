<nav class="c-sidebar-nav" aria-label="Navigasi utama">
    @foreach ($items as $item)
        <a
            href="{{ $item['url'] }}"
            class="c-sidebar-nav__item {{ ($item['active'] ?? false) ? 'is-active' : '' }}"
            title="{{ $item['label'] }}"
            @if ($item['active'] ?? false) aria-current="page" @endif
        >
            <x-ui.icon :name="$item['icon']" :size="20" class="shrink-0" />
            <span class="c-sidebar-nav__label">{{ $item['label'] }}</span>
        </a>
    @endforeach
</nav>
