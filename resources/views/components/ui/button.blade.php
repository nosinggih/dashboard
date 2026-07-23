@props([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'iconRight' => null,
    'loading' => false,
    'disabled' => false,
])

@php
$variantClass = match ($variant) {
    'secondary' => 'c-btn--secondary',
    'ghost' => 'c-btn--ghost',
    'danger' => 'c-btn--danger',
    'link' => 'c-btn--link',
    'primary-gradient' => 'c-btn--primary-gradient',
    default => 'c-btn--primary',
};

$sizeClass = match ($size) {
    'sm' => 'c-btn--sm',
    'lg' => 'c-btn--lg',
    default => 'c-btn--md',
};

$iconSize = match ($size) {
    'sm' => 16,
    'lg' => 20,
    default => 20,
};

$isDisabled = $disabled || $loading;
@endphp

<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => "c-btn {$variantClass} {$sizeClass}",
    ]) }}
    @if ($isDisabled) disabled @endif
    aria-busy="{{ $loading ? 'true' : 'false' }}"
>
    @if ($loading)
        <span class="c-btn__spinner" aria-hidden="true"></span>
    @elseif ($icon)
        <x-ui.icon :name="$icon" :size="$iconSize" />
    @endif

    {{ $slot }}

    @if ($iconRight && ! $loading)
        <x-ui.icon :name="$iconRight" :size="$iconSize" />
    @endif
</button>
