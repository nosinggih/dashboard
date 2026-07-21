@props([
    'variant' => 'bar',
    'value' => 0,
    'max' => 100,
    'label' => null,
])

@php
$percent = $max > 0 ? min(100, max(0, ($value / $max) * 100)) : 0;
$radius = 18;
$circumference = 2 * M_PI * $radius;
$offset = $circumference - ($percent / 100) * $circumference;
@endphp

@if ($variant === 'ring')
    <div
        {{ $attributes->merge(['class' => 'c-progress-ring']) }}
        role="progressbar"
        aria-valuenow="{{ $value }}"
        aria-valuemin="0"
        aria-valuemax="{{ $max }}"
    >
        <svg viewBox="0 0 40 40" class="c-progress-ring__svg">
            <circle cx="20" cy="20" r="{{ $radius }}" class="c-progress-ring__track" />
            <circle
                cx="20" cy="20" r="{{ $radius }}"
                class="c-progress-ring__value"
                stroke-dasharray="{{ $circumference }}"
                stroke-dashoffset="{{ $offset }}"
            />
        </svg>

        @if ($label)
            <span class="c-progress-ring__label u-num">{{ $label }}</span>
        @endif
    </div>
@else
    <div {{ $attributes->merge(['class' => 'c-progress-bar-wrap']) }}>
        @if ($label)
            <div class="c-progress-bar__label">
                <span>{{ $label }}</span>
                <span class="u-num">{{ round($percent) }}%</span>
            </div>
        @endif

        <div class="c-progress-bar" role="progressbar" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="{{ $max }}">
            <div class="c-progress-bar__fill" style="width: {{ $percent }}%"></div>
        </div>
    </div>
@endif
