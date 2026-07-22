<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Ledgerly')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-ink">
    @php
        $topbarItems = config('nav.topbar');
        $visibleItems = array_slice($topbarItems, 0, 4);
        $overflowItems = array_slice($topbarItems, 4);
    @endphp

    <header class="c-topbar c-glass" x-data="topbarNav">
        <div class="c-topbar__inner">
            <a href="/" class="flex shrink-0 items-center gap-2 text-h2 font-display text-ink">
                <x-ui.icon name="wallet" :size="24" class="text-brand-600" />
                <span class="hidden sm:inline">Ledgerly</span>
            </a>

            <nav class="c-topbar-nav" aria-label="Navigasi utama">
                @foreach ($visibleItems as $item)
                    <a href="{{ $item['url'] }}" class="c-topbar-nav__link {{ ($item['active'] ?? false) ? 'is-active' : '' }}">{{ $item['label'] }}</a>
                @endforeach

                @if (count($overflowItems))
                    <x-ui.dropdown>
                        <x-slot:trigger>
                            <span class="c-topbar-nav__link inline-flex cursor-pointer items-center gap-1">
                                Lainnya <x-ui.icon name="chevron-down" :size="16" />
                            </span>
                        </x-slot:trigger>

                        @foreach ($overflowItems as $item)
                            <a href="{{ $item['url'] }}" class="c-dropdown__item">{{ $item['label'] }}</a>
                        @endforeach
                    </x-ui.dropdown>
                @endif
            </nav>

            <div class="flex items-center gap-2">
                <button type="button" class="c-icon-btn hidden sm:inline-flex" aria-label="Notifikasi">
                    <x-ui.icon name="bell" :size="20" />
                </button>
                <x-ui.avatar name="Aji Santoso" size="sm" />

                <button
                    type="button"
                    class="c-icon-btn lg:hidden"
                    data-js="topbar-toggle"
                    @click="mobileOpen = !mobileOpen"
                    :aria-expanded="mobileOpen.toString()"
                    aria-label="Buka menu navigasi"
                >
                    <x-ui.icon name="menu-2" :size="22" x-show="!mobileOpen" />
                    <x-ui.icon name="x" :size="22" x-show="mobileOpen" x-cloak />
                </button>
            </div>
        </div>

        <nav class="c-topbar-drawer" x-show="mobileOpen" x-cloak aria-label="Navigasi mobile">
            @foreach ($topbarItems as $item)
                <a href="{{ $item['url'] }}" class="c-topbar-drawer__link {{ ($item['active'] ?? false) ? 'is-active' : '' }}">{{ $item['label'] }}</a>
            @endforeach
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @yield('content')
    </main>
</body>
</html>
