@props([
    'label' => null,
    'helper' => null,
])

@php
$id = $attributes->get('id') ?? uniqid('toggle-');
@endphp

<div class="c-toggle-field">
    <label for="{{ $id }}" class="c-toggle">
        <span class="c-toggle__control">
            <input
                id="{{ $id }}"
                {{ $attributes->merge([
                    'type' => 'checkbox',
                    'class' => 'c-toggle__input peer',
                ]) }}
            />
            <span class="c-toggle__track" aria-hidden="true"></span>
            <span class="c-toggle__thumb" aria-hidden="true"></span>
        </span>

        @if ($label)
            <span class="c-toggle__label">{{ $label }}</span>
        @endif
    </label>

    @if ($helper)
        <p class="c-field__helper">{{ $helper }}</p>
    @endif
</div>
