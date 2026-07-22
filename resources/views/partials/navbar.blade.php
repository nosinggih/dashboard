@php
$navLinks = [
    ['label' => 'Fitur', 'url' => '#fitur'],
    ['label' => 'Harga', 'url' => '#harga'],
    ['label' => 'Tentang', 'url' => '#tentang'],
];
@endphp

<header class="c-navbar c-glass" x-data="{ mobileOpen: false }">
    <a href="/" class="c-navbar__brand">
        <x-ui.icon name="wallet" :size="24" class="text-brand-600" />
        Ledgerly
    </a>

    <nav class="c-navbar__links" aria-label="Navigasi utama">
        @foreach ($navLinks as $link)
            <a href="{{ $link['url'] }}" class="transition-colors duration-fast ease-standard hover:text-brand-600">{{ $link['label'] }}</a>
        @endforeach
    </nav>

    <div class="c-navbar__actions">
        <a href="#" class="c-btn c-btn--ghost c-btn--sm hidden sm:inline-flex">Masuk</a>
        <a href="#" class="c-btn c-btn--primary c-btn--sm hidden sm:inline-flex">Daftar</a>

        <button
            type="button"
            class="c-icon-btn md:hidden"
            data-js="navbar-toggle"
            @click="mobileOpen = !mobileOpen"
            :aria-expanded="mobileOpen.toString()"
            aria-label="Buka menu navigasi"
        >
            <x-ui.icon name="menu-2" :size="22" x-show="!mobileOpen" />
            <x-ui.icon name="x" :size="22" x-show="mobileOpen" x-cloak />
        </button>
    </div>

    <nav class="c-navbar__drawer" x-show="mobileOpen" x-cloak aria-label="Navigasi mobile">
        @foreach ($navLinks as $link)
            <a href="{{ $link['url'] }}" class="c-topbar-drawer__link">{{ $link['label'] }}</a>
        @endforeach
        <div class="mt-2 flex gap-2 px-3">
            <a href="#" class="c-btn c-btn--secondary c-btn--sm flex-1 justify-center">Masuk</a>
            <a href="#" class="c-btn c-btn--primary c-btn--sm flex-1 justify-center">Daftar</a>
        </div>
    </nav>
</header>
