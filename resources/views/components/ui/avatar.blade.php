@props([
    'size' => 'md',
    'name' => null,
    'src' => null,
])

@php
$sizeClass = match ($size) {
    'xs' => 'c-avatar--xs',
    'sm' => 'c-avatar--sm',
    'lg' => 'c-avatar--lg',
    default => 'c-avatar--md',
};

$initials = null;

if (! $src && $name) {
    $parts = preg_split('/\s+/', trim($name));
    $initials = strtoupper(($parts[0][0] ?? '') . ($parts[1][0] ?? ''));
}
@endphp

<span {{ $attributes->merge(['class' => "c-avatar {$sizeClass}"]) }}>
    @if ($src)
        <img src="{{ $src }}" alt="{{ $name ?? '' }}" class="c-avatar__img" />
    @else
        <span class="c-avatar__initials" aria-hidden="true">{{ $initials }}</span>
        <span class="sr-only">{{ $name }}</span>
    @endif
</span>
