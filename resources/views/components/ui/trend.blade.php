@props([
    'direction' => 'up',
    'value' => null,
])

@php
$isUp = $direction === 'up';
$colorClass = $isUp ? 'c-trend--positive' : 'c-trend--negative';
$icon = $isUp ? 'trending-up' : 'trending-down';
@endphp

<span {{ $attributes->merge(['class' => "c-trend {$colorClass}"]) }}>
    <x-ui.icon :name="$icon" :size="16" />
    <span class="u-num">{{ $value ?? $slot }}</span>
</span>
