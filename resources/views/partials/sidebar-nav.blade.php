<nav class="c-sidebar-nav" aria-label="Navigasi utama">
    @foreach ($items as $item)
        @if (isset($item['children']) && is_array($item['children']))
            @php
                $hasActiveChild = collect($item['children'])->some(fn($c) => $c['active'] ?? false);
                $shouldOpenByDefault = $hasActiveChild ? 'true' : 'false';
            @endphp
            {{-- Item dengan submenu --}}
            <div
                x-data="{ open: {{ $shouldOpenByDefault }} }"
                @click.outside="open = false"
                @keydown.escape="open = false"
                class="c-sidebar-nav__group"
            >
                {{-- Parent item (accordion trigger) --}}
                <button
                    @click="open = !open"
                    type="button"
                    class="c-sidebar-nav__item {{ $hasActiveChild ? 'is-parent-active' : '' }}"
                    :aria-expanded="open"
                    :class="{ 'is-open': open }"
                >
                    <x-ui.icon :name="$item['icon']" :size="20" class="shrink-0" />
                    <span class="c-sidebar-nav__label">{{ $item['label'] }}</span>
                    <x-ui.icon name="chevron-down" :size="16" class="c-sidebar-nav__chevron shrink-0 ml-auto" class="{ 'rotate-180': open }" />
                </button>

                {{-- Flyout (saat sidebar collapsed) --}}
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-cloak
                    x-transition.origin.left
                    class="c-sidebar-nav__flyout"
                    role="menu"
                >
                    @foreach ($item['children'] as $child)
                        <a
                            href="{{ $child['url'] }}"
                            class="c-sidebar-nav__flyout-item {{ ($child['active'] ?? false) ? 'is-active' : '' }}"
                            title="{{ $child['label'] }}"
                            @if ($child['active'] ?? false) aria-current="page" @endif
                            role="menuitem"
                        >
                            <x-ui.icon :name="$child['icon']" :size="16" class="shrink-0" />
                            <span class="c-sidebar-nav__label">{{ $child['label'] }}</span>
                        </a>
                    @endforeach
                </div>

                {{-- Submenu list (accordion expand/collapse saat full-width) --}}
                <div
                    x-show="open"
                    x-cloak
                    x-transition
                    class="c-sidebar-nav__submenu"
                    role="group"
                >
                    @foreach ($item['children'] as $child)
                        <a
                            href="{{ $child['url'] }}"
                            class="c-sidebar-nav__submenu-item {{ ($child['active'] ?? false) ? 'is-active' : '' }}"
                            title="{{ $child['label'] }}"
                            @if ($child['active'] ?? false) aria-current="page" @endif
                        >
                            <x-ui.icon :name="$child['icon']" :size="16" class="shrink-0" />
                            <span class="c-sidebar-nav__label">{{ $child['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            {{-- Item tanpa submenu (flat) --}}
            <a
                href="{{ $item['url'] }}"
                class="c-sidebar-nav__item {{ ($item['active'] ?? false) ? 'is-active' : '' }}"
                title="{{ $item['label'] }}"
                @if ($item['active'] ?? false) aria-current="page" @endif
            >
                <x-ui.icon :name="$item['icon']" :size="20" class="shrink-0" />
                <span class="c-sidebar-nav__label">{{ $item['label'] }}</span>
            </a>
        @endif
    @endforeach
</nav>
