<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Ledgerly')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-ink">
    <div class="c-shell" x-data="sidebarShell">
        <div class="c-shell__overlay" x-show="mobileOpen" x-cloak @click="mobileOpen = false" aria-hidden="true"></div>

        <aside class="c-shell__sidebar" :class="{ 'is-open': mobileOpen, 'is-collapsed': collapsed }">
            <div class="c-shell__sidebar-head">
                <a href="/" class="flex items-center gap-2 text-h2 font-display text-ink c-shell__sidebar-head-text">
                    <x-ui.icon name="wallet" :size="24" class="shrink-0 text-brand-600" />
                    <span>Ledgerly</span>
                </a>
                <button
                    type="button"
                    class="c-icon-btn hidden lg:inline-flex"
                    data-js="sidebar-collapse"
                    @click="toggleCollapse()"
                    :aria-expanded="(!collapsed).toString()"
                    aria-label="Ciutkan sidebar"
                >
                    <x-ui.icon name="chevron-left" :size="20" x-show="!collapsed" />
                    <x-ui.icon name="chevron-right" :size="20" x-show="collapsed" x-cloak />
                </button>
                <button
                    type="button"
                    class="c-icon-btn lg:hidden"
                    data-js="sidebar-close"
                    @click="mobileOpen = false"
                    aria-label="Tutup menu"
                >
                    <x-ui.icon name="x" :size="20" />
                </button>
            </div>

            <div class="c-shell__sidebar-body">
                @include('partials.sidebar-nav', ['items' => config('nav.sidebar')])
            </div>

            <div class="c-shell__sidebar-foot">
                <x-ui.avatar name="Aji Santoso" size="sm" />
                <div class="min-w-0 c-shell__sidebar-head-text">
                    <p class="truncate text-sm font-medium text-ink">Aji Santoso</p>
                    <p class="truncate text-xs text-ink-muted">aji@ledgerly.id</p>
                </div>
            </div>
        </aside>

        <div class="c-shell__main">
            <header class="c-shell__header c-glass">
                <button
                    type="button"
                    class="c-icon-btn lg:hidden"
                    data-js="sidebar-open"
                    @click="mobileOpen = true"
                    aria-label="Buka menu"
                >
                    <x-ui.icon name="menu-2" :size="22" />
                </button>

                <div class="flex-1"></div>

                <div class="flex items-center gap-2">
                    <button type="button" class="c-icon-btn" aria-label="Cari">
                        <x-ui.icon name="search" :size="20" />
                    </button>
                    <button type="button" class="c-icon-btn" aria-label="Notifikasi">
                        <x-ui.icon name="bell" :size="20" />
                    </button>
                    <x-ui.avatar name="Aji Santoso" size="sm" />
                </div>
            </header>

            <main class="c-shell__content">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
