@props([
    'steps' => [],
    'active' => 0,
])

<ol {{ $attributes->merge(['class' => 'c-stepper']) }}>
    @foreach ($steps as $i => $step)
        @php
            $isDone = $i < $active;
            $isActive = $i === $active;
        @endphp
        <li class="c-stepper__item {{ $isDone ? 'is-done' : '' }} {{ $isActive ? 'is-active' : '' }}">
            <span class="c-stepper__marker" aria-hidden="true">
                @if ($isDone)
                    <x-ui.icon name="check" :size="16" />
                @else
                    <span class="u-num">{{ $i + 1 }}</span>
                @endif
            </span>
            <span class="c-stepper__label">{{ $step }}</span>
        </li>
    @endforeach
</ol>
