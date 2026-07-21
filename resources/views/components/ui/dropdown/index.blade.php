@props([
    'align' => 'left',
])

<div x-data="{ open: false }" @click.outside="open = false" @keydown.escape="open = false" class="c-dropdown" data-js="dropdown">
    <span @click="open = !open">{{ $trigger }}</span>

    <div
        x-show="open"
        x-cloak
        x-transition.origin.top
        class="c-dropdown__panel {{ $align === 'right' ? 'c-dropdown__panel--right' : '' }}"
        @click="open = false"
        role="menu"
    >
        {{ $slot }}
    </div>
</div>
