@props([
    'icon' => 'search',
    'title' => null,
])

<div {{ $attributes->merge(['class' => 'c-empty-state']) }}>
    <x-ui.icon :name="$icon" :size="24" class="c-empty-state__icon" />

    @if ($title)
        <p class="c-empty-state__title">{{ $title }}</p>
    @endif

    <div class="c-empty-state__message">{{ $slot }}</div>

    @isset($cta)
        <div class="c-empty-state__cta">{{ $cta }}</div>
    @endisset
</div>
