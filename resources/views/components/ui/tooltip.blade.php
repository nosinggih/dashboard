@props([
    'text' => null,
    'position' => 'top',
])

@php
$positionClass = $position === 'bottom' ? 'c-tooltip__bubble--bottom' : 'c-tooltip__bubble--top';
@endphp

<span class="c-tooltip" tabindex="0">
    {{ $slot }}
    <span class="c-tooltip__bubble {{ $positionClass }}" role="tooltip">{{ $text }}</span>
</span>
