@props([
    'icon' => null,
])

<button type="button" role="menuitem" {{ $attributes->merge(['class' => 'c-dropdown__item']) }}>
    @if ($icon)
        <x-ui.icon :name="$icon" :size="16" />
    @endif
    {{ $slot }}
</button>
