@props([
    'label' => null,
    'error' => null,
    'helper' => null,
])

@php
$id = $attributes->get('id') ?? uniqid('radio-');
$hasError = filled($error);
@endphp

<div class="c-check-field">
    <div class="c-check-field__row">
        <input
            id="{{ $id }}"
            {{ $attributes->merge([
                'type' => 'radio',
                'class' => trim('c-radio ' . ($hasError ? 'c-radio--error' : '')),
            ]) }}
        />

        @if ($label)
            <label for="{{ $id }}" class="c-check-field__label">{{ $label }}</label>
        @endif
    </div>

    @if ($hasError)
        <p class="c-field__error">
            <x-ui.icon name="alert-circle" :size="16" class="c-field__error-icon" />
            {{ $error }}
        </p>
    @elseif ($helper)
        <p class="c-field__helper">{{ $helper }}</p>
    @endif
</div>
