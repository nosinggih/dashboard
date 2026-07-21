<svg
    {{ $attributes->merge([
        'class' => 'c-icon',
        'width' => $size,
        'height' => $size,
        'viewBox' => $viewBox,
        'fill' => 'none',
        'stroke' => 'currentColor',
        'stroke-width' => 2,
        'stroke-linecap' => 'round',
        'stroke-linejoin' => 'round',
        'aria-hidden' => 'true',
        'focusable' => 'false',
    ]) }}
>{!! $paths !!}</svg>
