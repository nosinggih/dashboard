@props([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => true,
])

@php
$variantClass = match ($variant) {
    'positive' => 'c-badge--positive',
    'negative' => 'c-badge--negative',
    'warning' => 'c-badge--warning',
    'info' => 'c-badge--info',
    default => 'c-badge--neutral',
};

$sizeClass = $size === 'sm' ? 'c-badge--sm' : 'c-badge--md';
@endphp

<span {{ $attributes->merge(['class' => "c-badge {$variantClass} {$sizeClass}"]) }}>
    @if ($dot)
        <span class="c-badge__dot" aria-hidden="true"></span>
    @endif
    {{ $slot }}
</span>
