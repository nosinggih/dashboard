@props([
    'variant' => 'text',
    'width' => null,
    'height' => null,
])

@php
$variantClass = match ($variant) {
    'circle' => 'c-skeleton--circle',
    'block' => 'c-skeleton--block',
    default => 'c-skeleton--text',
};

$style = collect([
    $width ? "width:{$width}" : null,
    $height ? "height:{$height}" : null,
])->filter()->implode(';');
@endphp

<span
    {{ $attributes->merge(['class' => "c-skeleton {$variantClass}"]) }}
    @if ($style) style="{{ $style }}" @endif
    aria-hidden="true"
></span>
