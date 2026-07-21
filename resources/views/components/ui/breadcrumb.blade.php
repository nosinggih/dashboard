@props([
    'items' => [],
])

<nav {{ $attributes->merge(['class' => 'c-breadcrumb']) }} aria-label="Breadcrumb">
    <ol class="c-breadcrumb__list">
        @foreach ($items as $i => $item)
            @php
                $isLast = $i === array_key_last($items);
            @endphp
            <li class="c-breadcrumb__item">
                @if (! $isLast && ! empty($item['url']))
                    <a href="{{ $item['url'] }}" class="c-breadcrumb__link">{{ $item['label'] }}</a>
                @else
                    <span class="c-breadcrumb__current" @if ($isLast) aria-current="page" @endif>{{ $item['label'] }}</span>
                @endif

                @unless ($isLast)
                    <x-ui.icon name="chevron-right" :size="16" class="c-breadcrumb__separator" />
                @endunless
            </li>
        @endforeach
    </ol>
</nav>
