<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Ledgerly')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- Kontrak: halaman yang @extends layout ini wajib mengirim $modules (daftar modul) dan $activeModule (modul aktif) --}}
<body class="bg-surface text-ink">
    <div class="c-shell" x-data="sidebarShell">
        <div class="c-shell__overlay" x-show="mobileOpen" x-cloak @click="mobileOpen = false" aria-hidden="true"></div>

        <aside class="c-shell__sidebar" :class="{ 'is-open': mobileOpen, 'is-collapsed': collapsed }">
            <div class="c-shell__sidebar-head">
                <span class="flex items-center gap-2 text-h2 font-display text-ink c-shell__sidebar-head-text">
                    <x-ui.icon :name="$activeModule['icon']" :size="24" class="shrink-0 text-brand-600" />
                    <span>{{ $activeModule['label'] }}</span>
                </span>
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
                @include('partials.sidebar-nav', ['items' => $activeModule['sidebar']])
            </div>
        </aside>

        <div class="c-shell__main">
            <header class="c-topbar c-glass" x-data="topbarNav">
                <div class="c-topbar__inner">
                    <button
                        type="button"
                        class="c-icon-btn lg:hidden"
                        data-js="sidebar-open"
                        @click="mobileOpen = true"
                        aria-label="Buka menu"
                    >
                        <x-ui.icon name="menu-2" :size="22" />
                    </button>

                    <nav class="c-topbar-nav" aria-label="Navigasi modul">
                        @foreach ($modules as $module)
                            <a
                                href="{{ route('styleguide.layouts.mix', ['modul' => $module['key']]) }}"
                                class="c-topbar-nav__link {{ $module['key'] === $activeModule['key'] ? 'is-active' : '' }}"
                            >{{ $module['label'] }}</a>
                        @endforeach
                    </nav>

                    <div class="flex items-center gap-2">
                        <button type="button" class="c-icon-btn" aria-label="Notifikasi">
                            <x-ui.icon name="bell" :size="20" />
                        </button>
                        <x-ui.avatar name="Aji Santoso" size="sm" />
                    </div>
                </div>
            </header>

            <main class="c-shell__content">
                <div class="mb-6">
                    @yield('breadcrumb')
                </div>

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
