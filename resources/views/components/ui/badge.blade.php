@props([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => true,
])

@php
$variantClass = match ($variant) {
    'positive' => 'c-badge--positive',
    'positive-gradient' => 'c-badge--positive-gradient',
    'negative' => 'c-badge--negative',
    'negative-gradient' => 'c-badge--negative-gradient',
    'warning' => 'c-badge--warning',
    'warning-gradient' => 'c-badge--warning-gradient',
    'info' => 'c-badge--info',
    'info-gradient' => 'c-badge--info-gradient',
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
