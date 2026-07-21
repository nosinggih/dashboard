@props([
    'variant' => 'default',
    'size' => 'md',
    'sticky' => false,
])

@php
$variantClass = match ($variant) {
    'striped' => 'c-table--striped',
    'bordered' => 'c-table--bordered',
    'compact' => 'c-table--compact',
    'card' => 'c-table--card',
    default => 'c-table--default',
};

$sizeClass = match ($size) {
    'sm' => 'c-table--sm',
    'lg' => 'c-table--lg',
    default => 'c-table--md',
};
@endphp

<div class="c-table-wrap">
    <table
        {{ $attributes->merge([
            'class' => trim("c-table {$variantClass} {$sizeClass} " . ($sticky ? 'c-table--sticky' : '')),
        ]) }}
    >
        {{ $slot }}
    </table>
</div>
