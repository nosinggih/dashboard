@props([
    'label' => null,
    'size' => 'md',
    'error' => null,
    'helper' => null,
    'required' => false,
    'icon' => false,
])

@php
$id = $attributes->get('id') ?? 'datepicker-' . uniqid();
$sizeClass = match ($size) {
    'sm' => 'c-input--sm',
    'lg' => 'c-input--lg',
    default => 'c-input--md',
};
$hasError = filled($error);
$errorClass = $hasError ? 'c-input--error' : '';
@endphp

<div class="c-field">
    @if ($label)
        <label for="{{ $id }}" class="c-field__label">
            {{ $label }}
            @if ($required)
                <span class="c-field__required" aria-label="diperlukan">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input
            {{ $attributes->merge([
                'type' => 'text',
                'id' => $id,
                'class' => "c-input {$sizeClass} {$errorClass}",
                'data-js' => 'date-input',
                'placeholder' => 'dd/mm/yyyy',
                'readonly' => true,
            ]) }}
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            @if ($hasError) aria-describedby="{{ $id }}-error" @endif
            @if ($helper && !$hasError) aria-describedby="{{ $id }}-helper" @endif
        />
        @if ($icon)
            <x-ui.icon name="calendar" :size="20" class="absolute right-3 top-1/2 -translate-y-1/2 text-ink-muted pointer-events-none shrink-0" />
        @endif
    </div>

    @if ($hasError)
        <div class="c-field__error" id="{{ $id }}-error" role="alert">
            <x-ui.icon name="alert-circle" :size="16" class="c-field__error-icon" />
            <span>{{ $error }}</span>
        </div>
    @elseif ($helper)
        <p class="c-field__helper" id="{{ $id }}-helper">{{ $helper }}</p>
    @endif
</div>

@once
    @push('scripts')
        @vite('resources/js/modules/date-picker.js')
    @endpush
@endonce
