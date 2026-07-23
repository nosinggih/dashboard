@props([
    'variant' => 'default',
    'label' => null,
    'value' => null,
    'gradient' => null,
])

@php
$variantClass = match ($variant) {
    'flat' => 'c-card--flat',
    'stat' => 'c-card--stat',
    default => 'c-card--default',
};

$gradientClass = '';
if ($variant === 'stat' && $gradient) {
    $gradientClass = match ($gradient) {
        'positive' => 'c-card--stat-positive-gradient',
        'negative' => 'c-card--stat-negative-gradient',
        'warning' => 'c-card--stat-warning-gradient',
        'info' => 'c-card--stat-info-gradient',
        'brand' => 'c-card--stat-brand-gradient',
        default => '',
    };
}
@endphp

<div {{ $attributes->merge(['class' => "c-card {$variantClass} {$gradientClass}"]) }}>
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
