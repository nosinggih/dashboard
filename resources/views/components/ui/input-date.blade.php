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
        <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const inputs = document.querySelectorAll('[data-js="date-input"]');
                inputs.forEach(input => {
                    flatpickr(input, {
                        mode: 'single',
                        dateFormat: 'd/m/Y',
                        altInput: false,
                        altFormat: 'd/m/Y',
                        locale: {
                            firstDayOfWeek: 1,
                            weekdays: {
                                shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                                longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                            },
                            months: {
                                shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                                longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                            },
                        },
                        onReady: function(selectedDates, dateStr, instance) {
                            const calendar = instance.calendarContainer;
                            calendar.classList.add('fp-theme-dark-custom');
                        },
                    });
                });
            });
        </script>
        <style>
            /* Flatpickr customization — override default theme to match design system */
            .flatpickr-calendar {
                @apply bg-surface-card border border-line rounded-md shadow-modal;
                background: var(--color-surface-card) !important;
                border: 1px solid var(--color-border) !important;
                box-shadow: var(--shadow-modal) !important;
            }
            .flatpickr-calendar.open {
                z-index: 99;
            }
            .flatpickr-months {
                @apply bg-transparent;
                background-color: transparent !important;
            }
            .flatpickr-month {
                @apply text-ink;
                color: var(--color-text-primary) !important;
            }
            .flatpickr-current-month input.cur-year,
            .flatpickr-current-month .cur-month {
                @apply text-ink;
                color: var(--color-text-primary) !important;
            }
            .flatpickr-prev-month,
            .flatpickr-next-month {
                @apply text-ink-muted hover:text-ink;
                color: var(--color-text-muted) !important;
            }
            .flatpickr-prev-month:hover,
            .flatpickr-next-month:hover {
                color: var(--color-text-primary) !important;
            }
            .flatpickr-weekdays {
                @apply bg-surface-sunken text-ink-muted text-xs;
                background-color: var(--color-surface-sunken) !important;
                color: var(--color-text-muted) !important;
            }
            .flatpickr-weekdaycontainer .flatpickr-weekday {
                @apply text-xs font-medium;
                font-weight: 500 !important;
            }
            .flatpickr-day {
                @apply text-ink;
                color: var(--color-text-primary) !important;
                max-width: 2.25rem;
            }
            .flatpickr-day:hover {
                @apply bg-brand-50 text-brand-700;
                background-color: var(--color-brand-50) !important;
                color: var(--color-brand-700) !important;
            }
            .flatpickr-day.selected {
                @apply bg-brand-600 text-white;
                background-color: var(--color-brand-600) !important;
                color: white !important;
            }
            .flatpickr-day.selected:hover {
                @apply bg-brand-700;
                background-color: var(--color-brand-700) !important;
            }
            .flatpickr-day.today {
                @apply border-brand-600;
                border-color: var(--color-brand-600) !important;
            }
            .flatpickr-day.inRange {
                @apply bg-brand-100 text-ink;
                background-color: var(--color-brand-100) !important;
            }
            .flatpickr-day.disabled,
            .flatpickr-day.prevMonthDay,
            .flatpickr-day.nextMonthDay {
                @apply text-ink-muted opacity-50;
                color: var(--color-text-muted) !important;
            }
        </style>
    @endpush
@endonce
