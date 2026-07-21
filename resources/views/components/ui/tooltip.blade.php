@props([
    'text' => null,
    'position' => 'top',
])

<span class="c-tooltip" tabindex="0">
    {{ $slot }}
    <span class="c-tooltip__bubble c-tooltip__bubble--{{ $position }}" role="tooltip">{{ $text }}</span>
</span>
