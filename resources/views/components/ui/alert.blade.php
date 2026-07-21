@props([
    'variant' => 'info',
    'dismissible' => false,
    'title' => null,
])

@php
$variantClass = match ($variant) {
    'positive' => 'c-alert--positive',
    'negative' => 'c-alert--negative',
    'warning' => 'c-alert--warning',
    default => 'c-alert--info',
};

$icon = match ($variant) {
    'positive' => 'circle-check',
    'negative' => 'alert-circle',
    'warning' => 'alert-triangle',
    default => 'info-circle',
};

$iconColorClass = match ($variant) {
    'positive' => 'text-positive',
    'negative' => 'text-negative',
    'warning' => 'text-warning',
    default => 'text-info',
};
@endphp

<div
    @if ($dismissible) x-data="{ open: true }" x-show="open" @endif
    {{ $attributes->merge(['class' => "c-alert {$variantClass}", 'role' => 'alert']) }}
>
    <x-ui.icon :name="$icon" :size="20" class="{{ $iconColorClass }} shrink-0" />

    <div class="c-alert__body">
        @if ($title)
            <p class="c-alert__title">{{ $title }}</p>
        @endif
        <div class="c-alert__message">{{ $slot }}</div>
    </div>

    @if ($dismissible)
        <button type="button" class="c-alert__dismiss" @click="open = false" aria-label="Tutup notifikasi">
            <x-ui.icon name="x" :size="16" />
        </button>
    @endif
</div>
