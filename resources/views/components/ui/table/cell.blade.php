@props([
    'type' => 'text',
    'header' => false,
    'label' => null,
])

@php
$tag = $header ? 'th' : 'td';

$alignClass = match ($type) {
    'number' => 'text-right u-num',
    'status' => 'text-center',
    default => 'text-left',
};
@endphp

<{{ $tag }}
    {{ $attributes->merge(['class' => "c-table__cell {$alignClass}"]) }}
    @if ($header) scope="col" @endif
    @if ($label) data-label="{{ $label }}" @endif
>{{ $slot }}</{{ $tag }}>
