@props([
    'variant' => 'default',
    'label' => null,
    'value' => null,
])

@php
$variantClass = match ($variant) {
    'flat' => 'c-card--flat',
    'stat' => 'c-card--stat',
    default => 'c-card--default',
};
@endphp

<div {{ $attributes->merge(['class' => "c-card {$variantClass}"]) }}>
    @if ($variant === 'stat')
        @if ($label)
            <p class="c-card__stat-label">{{ $label }}</p>
        @endif

        @if ($value)
            <p class="c-card__stat-value u-num font-display">{{ $value }}</p>
        @endif

        @isset($trend)
            <div class="c-card__stat-trend">{{ $trend }}</div>
        @endisset

        {{ $slot }}
    @else
        @isset($header)
            <div class="c-card__header">{{ $header }}</div>
        @endisset

        <div class="c-card__body">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="c-card__footer">{{ $footer }}</div>
        @endisset
    @endif
</div>
