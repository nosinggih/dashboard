@props([
    'label' => null,
    'size' => 'md',
    'error' => null,
    'helper' => null,
    'required' => false,
    'rows' => 4,
])

@php
$id = $attributes->get('id') ?? uniqid('textarea-');

$sizeClass = match ($size) {
    'sm' => 'c-input--sm',
    'lg' => 'c-input--lg',
    default => 'c-input--md',
};

$hasError = filled($error);
@endphp

<div class="c-field">
    @if ($label)
        <label for="{{ $id }}" class="c-field__label">
            {{ $label }}
            @if ($required)
                <span class="c-field__required" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <textarea
        id="{{ $id }}"
        rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' => trim("c-input c-textarea {$sizeClass} " . ($hasError ? 'c-input--error' : '')),
        ]) }}
        @if ($required) required @endif
        @if ($hasError)
            aria-invalid="true"
            aria-describedby="{{ $id }}-error"
        @elseif ($helper)
            aria-describedby="{{ $id }}-helper"
        @endif
    >{{ $slot }}</textarea>

    @if ($hasError)
        <p id="{{ $id }}-error" class="c-field__error">
            <x-ui.icon name="alert-circle" :size="16" class="c-field__error-icon" />
            {{ $error }}
        </p>
    @elseif ($helper)
        <p id="{{ $id }}-helper" class="c-field__helper">{{ $helper }}</p>
    @endif
</div>
