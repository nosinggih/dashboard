@props([
    'label' => null,
    'size' => 'md',
    'error' => null,
    'helper' => null,
    'required' => false,
    'options' => [],
    'placeholder' => 'Pilih...',
])

@php
$id = $attributes->get('id') ?? 'select-search-' . uniqid();
$name = $attributes->get('name');
$sizeClass = match ($size) {
    'sm' => 'c-input--sm',
    'lg' => 'c-input--lg',
    default => 'c-input--md',
};
$hasError = filled($error);
$optionList = collect($options)->map(fn ($optLabel, $value) => ['value' => (string) $value, 'label' => $optLabel])->values();
$currentValue = (string) ($attributes->get('value') ?? ($name ? old($name) : null) ?? '');
@endphp

<div
    class="c-field"
    x-data="selectSearch({ options: {{ Illuminate\Support\Js::from($optionList) }}, selected: '{{ $currentValue }}' })"
    data-js="select-search"
>
    @if ($label)
        <label for="{{ $id }}" class="c-field__label">
            {{ $label }}
            @if ($required)
                <span class="c-field__required" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <select
            x-ref="native"
            id="{{ $id }}"
            :tabindex="enhanced ? -1 : 0"
            :aria-hidden="enhanced.toString()"
            :class="{ 'sr-only': enhanced }"
            {{ $attributes->except(['value'])->merge([
                'class' => trim("c-input {$sizeClass} " . ($hasError ? 'c-input--error' : '')),
            ]) }}
            @if ($required) required @endif
            @if ($hasError)
                aria-invalid="true"
                aria-describedby="{{ $id }}-error"
            @elseif ($helper)
                aria-describedby="{{ $id }}-helper"
            @endif
        >
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $value => $optLabel)
                <option value="{{ $value }}" @selected($currentValue === (string) $value)>{{ $optLabel }}</option>
            @endforeach
        </select>

        <template x-if="enhanced">
            <div>
                <button
                    type="button"
                    class="c-input {{ $sizeClass }} {{ $hasError ? 'c-input--error' : '' }} c-select-search__trigger"
                    :class="{ 'is-open': open }"
                    @click="toggle()"
                    @keydown.down.prevent="openAndFocus()"
                    @keydown.up.prevent="openAndFocus()"
                    role="combobox"
                    aria-haspopup="listbox"
                    :aria-expanded="open.toString()"
                    aria-controls="{{ $id }}-listbox"
                >
                    <span x-text="selectedLabel || '{{ $placeholder }}'" :class="{ 'text-ink-muted': !selectedLabel }"></span>
                    <x-ui.icon name="chevron-down" :size="16" class="c-select-search__chevron" />
                </button>

                <div
                    x-show="open"
                    x-cloak
                    x-transition.origin.top
                    @click.outside="close()"
                    class="c-select-search__panel"
                >
                    <div class="c-select-search__search">
                        <x-ui.icon name="search" :size="16" class="c-select-search__search-icon" />
                        <input
                            type="text"
                            x-ref="search"
                            x-model="query"
                            @keydown.down.prevent="highlightNext()"
                            @keydown.up.prevent="highlightPrev()"
                            @keydown.enter.prevent="selectHighlighted()"
                            @keydown.escape.prevent="close()"
                            class="c-select-search__search-input"
                            placeholder="Cari..."
                            autocomplete="off"
                            role="searchbox"
                            :aria-activedescendant="activeIndex >= 0 ? '{{ $id }}-opt-' + activeIndex : null"
                        />
                    </div>

                    <ul class="c-select-search__list" x-ref="list" id="{{ $id }}-listbox" role="listbox">
                        <template x-for="(opt, i) in filtered" :key="opt.value">
                            <li
                                :id="'{{ $id }}-opt-' + i"
                                role="option"
                                :aria-selected="(opt.value === selected).toString()"
                                :class="{ 'is-active': i === activeIndex, 'is-selected': opt.value === selected }"
                                class="c-select-search__option"
                                @click="choose(opt)"
                                @mouseenter="activeIndex = i"
                                x-text="opt.label"
                            ></li>
                        </template>
                        <li x-show="filtered.length === 0" class="c-select-search__empty">Tidak ditemukan</li>
                    </ul>
                </div>
            </div>
        </template>
    </div>

    @if ($hasError)
        <p id="{{ $id }}-error" class="c-field__error" role="alert">
            <x-ui.icon name="alert-circle" :size="16" class="c-field__error-icon" />
            {{ $error }}
        </p>
    @elseif ($helper)
        <p id="{{ $id }}-helper" class="c-field__helper">{{ $helper }}</p>
    @endif
</div>
