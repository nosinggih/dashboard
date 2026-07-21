@props([
    'variant' => 'info',
    'title' => null,
    'duration' => 4000,
])

@php
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
    x-data="{ open: true }"
    x-show="open"
    x-cloak
    x-init="setTimeout(() => open = false, {{ (int) $duration }})"
    x-transition
    {{ $attributes->merge(['class' => 'c-toast', 'role' => 'status', 'aria-live' => 'polite']) }}
>
    <x-ui.icon :name="$icon" :size="20" class="{{ $iconColorClass }} shrink-0" />

    <div class="c-toast__body">
        @if ($title)
            <p class="c-toast__title">{{ $title }}</p>
        @endif
        <div class="c-toast__message">{{ $slot }}</div>
    </div>

    <button type="button" class="c-toast__dismiss" @click="open = false" aria-label="Tutup notifikasi">
        <x-ui.icon name="x" :size="16" />
    </button>
</div>
